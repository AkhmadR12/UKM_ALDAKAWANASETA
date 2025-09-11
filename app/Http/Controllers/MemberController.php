<?php

namespace App\Http\Controllers;

use App\Models\KabupatenKota;
use App\Models\Member;
use App\Models\User;
use App\Notifications\MemberExpiredNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Milon\Barcode\DNS1D;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Illuminate\Support\Facades\Mail;
use App\Mail\MemberNotificationMail;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private function generateIdMember($kota_id, $tanggal_bergabung)
    {
        $prefix = 'AFI';

        $kota = KabupatenKota::findOrFail($kota_id);
        $kodeKota = $kota->id;

        $tanggal = \Carbon\Carbon::parse($tanggal_bergabung);
        $datePart = $tanggal->format('dm y'); // ex: 060524
        $datePart = str_replace(' ', '', $datePart);

        // Hitung jumlah member di bulan dan tahun yang sama (tidak peduli kota)
        $count = Member::whereMonth('tanggal_bergabung', $tanggal->month)
            ->whereYear('tanggal_bergabung', $tanggal->year)
            ->count() + 1;

        $urut = str_pad($count, 4, '0', STR_PAD_LEFT);

        return "{$prefix}.{$kodeKota}.{$datePart}.{$urut}";
    }
    // public function index()
    // {
    //     $members = Member::with('kota')->get();
    //     return view('admin.member.index', compact('members'));
    // }


    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $members = Member::with('kota')->get();
        } else {
            $members = Member::with('kota')
                ->where('user_id', $user->id)
                ->whereDate('tanggal_berakhir', '>=', now()) // hanya jika masih aktif
                ->get();
        }

        // ✅ Cek peringatan H-8
        $warning = null;
        if ($user->role === 'member') {
            $member = Member::where('user_id', $user->id)->first();
            if ($member) {
                $tanggalBerakhir = Carbon::parse($member->tanggal_berakhir);
                $sisaHari = now()->diffInDays($tanggalBerakhir, false);

                if ($sisaHari <= 8 && $sisaHari >= 0) {
                    $warning = [
                        'sisa_hari' => $sisaHari,
                        // ✅ gunakan Y-m-d untuk pemrosesan
                        'tanggal_berakhir' => $tanggalBerakhir->format('Y-m-d'),
                        // ✅ opsional: jika mau ditampilkan cantik di Blade tetap bisa pakai format d/m/Y
                        'tanggal_berakhir_display' => $tanggalBerakhir->format('d/m/Y')
                    ];
                }
            }
        }

        return view('admin.member.index', compact('members', 'warning'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kabupatenKotas = KabupatenKota::all();
        return view('admin.member.create', compact('kabupatenKotas'));
    }
    public function payment()
    {
        $kabupatenKotas = KabupatenKota::all();
        return view('frontend.member.payment', compact('kabupatenKotas'));
    }
    public function registerPayment()
    {
        $kabupatenKotas = KabupatenKota::all();
        $paymentAmount = 100000; // Set your membership fee amount here
        return view('frontend.member.register-payment', compact('kabupatenKotas', 'paymentAmount'));
    }

    public function processRegisterPayment(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:members,email|unique:users,email',
            'kota_id' => 'required|exists:kabupaten_kota,id',
            'tanggal_bergabung' => 'required|date',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'payment_proof' => 'required|file|mimes:jpeg,png,jpg,gif,pdf|max:2048',
            'payment_method' => 'required|string',
            'password' => 'required|min:8|confirmed',
        ]);

        DB::beginTransaction();
        try {
            // Create User first
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'member',
                'subdep_kode' => '001',
            ]);

            // Handle file uploads
            $photoPath = $this->uploadFile($request->file('photo'), 'member_photos', $request->name);
            $paymentProofPath = $this->uploadFile($request->file('payment_proof'), 'payment_proofs', $request->name);

            // ✅ Hitung tanggal_berakhir otomatis (1 tahun setelah tanggal_bergabung)
            $tanggalBerakhir = Carbon::parse($request->tanggal_bergabung)->addYear();

            // Create Member associated with the User
            $memberData = [
                'id_member' => $this->generateIdMember($request->kota_id, $request->tanggal_bergabung),
                'user_id' => $user->id,  // Link to the user
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'kota_id' => $request->kota_id,
                'tanggal_bergabung' => $request->tanggal_bergabung,
                'tanggal_berakhir' => $tanggalBerakhir,
                'status' => 'OPE1',  // Or whatever your initial status should be
                'photo' => $photoPath,
                'bukti_tf' => $paymentProofPath,
                'payment_method' => $request->payment_method,
            ];

            $member = Member::create($memberData);

            DB::commit();

            // Log in the user
            Auth::login($user);

            // Send email verification if needed
            event(new Registered($user));

            return redirect()->route('home')->with([
                'success' => 'Registration and payment successful!',
                'member_id' => $member->id_member
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Registration failed: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all()
            ]);

            return back()->withInput()->with('error', 'Registration failed. Please try again.');
        }
    }


    private function uploadFile($file, $folder, $prefix)
    {
        $publicPath = public_path($folder);
        if (!File::exists($publicPath)) {
            File::makeDirectory($publicPath, 0755, true);
        }

        $extension = $file->getClientOriginalExtension();
        $safeName = Str::slug($prefix) . '-' . uniqid() . '.' . $extension;
        $file->move($publicPath, $safeName);

        return $folder . '/' . $safeName;
    }
    public function sendExpiredNotifications()
    {
        $today = Carbon::now()->format('Y-m-d');

        $members = Member::whereDate('tanggal_berakhir', $today)->get();

        foreach ($members as $member) {
            $member->notify(new MemberExpiredNotification($member));
        }

        return response()->json([
            'message' => 'Notifikasi berhasil dikirim ke semua member yang masa berlakunya berakhir hari ini.',
            'count' => $members->count()
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:members,email',
            'kota_id' => 'required|exists:kabupaten_kota,id',
            'tanggal_bergabung' => 'required|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'phone', 'email', 'kota_id', 'tanggal_bergabung']);
        $data['id_member'] = $this->generateIdMember($request->kota_id, $request->tanggal_bergabung);
        $data['status'] = 'OPEN';

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $extension = $image->getClientOriginalExtension();
            $safeName = Str::slug($request->name) . '-' . time() . '.' . $extension;
            $destinationPath = public_path('member_photos');
            $image->move($destinationPath, $safeName);
            $data['photo'] = 'member_photos/' . $safeName;
        }

        Member::create($data);

        return redirect('/members')->with('success', 'Member berhasil ditambahkan');
    }
    public function sertifikat($id_member)
    {
        $member = Member::with('kota')->findOrFail($id_member);
        return view('admin.member.sertifikat', compact('member'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        return view('admin.member.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_member)
    {
        $member = Member::where('id_member', $id_member)->firstOrFail();
        $kabupatenKotas = KabupatenKota::all();
        return view('admin.member.edit', compact('member', 'kabupatenKotas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'kota_id' => 'required|exists:kabupaten_kota,id',
            'tanggal_bergabung' => 'required|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'barcode_path' => 'required|image|mimes:png,jpg,jpeg|max:2048', // barcode wajib saat edit
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            if ($member->photo && file_exists(public_path($member->photo))) {
                unlink(public_path($member->photo));
            }
            $photo = $request->file('photo');
            $photoName = time() . '-' . $photo->getClientOriginalName();
            $photo->move(public_path('member_photos'), $photoName);
            $validated['photo'] = 'member_photos/' . $photoName;
        }

        // Handle barcode upload
        if ($request->hasFile('barcode_path')) {
            if ($member->barcode_path && file_exists(public_path($member->barcode_path))) {
                unlink(public_path($member->barcode_path));
            }
            $barcode = $request->file('barcode_path');
            $barcodeName = 'barcode-' . $member->id_member . '-' . time() . '.' . $barcode->getClientOriginalExtension();
            $barcode->move(public_path('storage/barcodes'), $barcodeName);
            $validated['barcode_path'] = 'storage/barcodes/' . $barcodeName;
        }

        // Update status menjadi INP
        $validated['status'] = 'INPG';

        $member->update($validated);

        return redirect()->route('members.index')->with('success', 'Member updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('members.index')
            ->with('success', 'Member deleted successfully');
    }
    public function showCard($id_member)
    {
        $member = Member::findOrFail($id_member);
        $barcodePath = 'storage/barcodes/' . $id_member . '.png';

        return view('admin.member.card', compact('member', 'barcodePath'));
    }

    private function generateBarcode($id_member)
    {
        $url = route('members.card', $id_member); // url tujuan barcode

        $barcodeGenerator = new DNS1D();
        $barcodeGenerator->setStorPath(public_path('storage/barcodes/')); // optional, untuk caching
        $barcodeData = $barcodeGenerator->getBarcodePNG($url, 'C128');

        $barcodeImage = base64_decode($barcodeData);
        $directory = public_path('storage/barcodes');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $filename = $id_member . '.png';
        file_put_contents($directory . '/' . $filename, $barcodeImage);

        return 'storage/barcodes/' . $filename;
    }

    // public function toggleStatus($id)
    // {
    //     $member = Member::findOrFail($id);
    //     $member->status = $member->status === 'OPEN' ? 'OPE1' : 'OPEN';
    //     $member->save();

    //     return response()->json([
    //         'success' => true,
    //         'status' => $member->status
    //     ]);
    // }
    public function toggleStatus($id_member)
    {
        $member = Member::where('id_member', $id_member)->firstOrFail();
        $member->status = $member->status === 'OPEN' ? 'OPE1' : 'OPEN';
        $member->save();

        return response()->json([
            'success' => true,
            'status' => $member->status
        ]);
    }
    public function extend(Request $request)
    {
        $request->validate([
            'bukti_tf' => 'required|image|max:2048',
        ]);

        $user = Auth::user();
        $member = Member::where('user_id', $user->id)->firstOrFail();

        // Upload bukti transfer
        $path = $request->file('bukti_tf')->store('bukti_tf', 'public');

        // Update data member untuk perpanjangan (status pending)
        $member->update([
            'bukti_tf' => $path,
            'status_pembayaran' => 'pending'
        ]);

        return response()->json(['success' => true]);
    }
    // public function approveExtension($id_member)
    // {
    //     $member = Member::where('id_member', $id_member)->firstOrFail();

    //     // Update status pembayaran menjadi done
    //     $member->status_pembayaran = 'done';

    //     // Perpanjang masa aktif 1 tahun ke depan dari tanggal_berakhir saat ini
    //     $member->tanggal_berakhir = \Carbon\Carbon::parse($member->tanggal_berakhir)->addYear();

    //     $member->save();

    //     return back()->with('success', 'Perpanjangan disetujui dan masa aktif diperpanjang 1 tahun.');
    // }
    public function approveExtension($id_member)
    {
        try {
            $member = Member::where('id_member', $id_member)->firstOrFail();

            // Pastikan status pembayaran pending
            if ($member->status_pembayaran !== 'pending') {
                return response()->json(['success' => false, 'message' => 'Status pembayaran sudah diproses.']);
            }

            // Update status pembayaran dan perpanjang masa aktif 1 tahun
            $member->status_pembayaran = 'done';
            $member->tanggal_berakhir = \Carbon\Carbon::parse($member->tanggal_berakhir)->addYear();
            $member->save();

            return response()->json(['success' => true, 'message' => 'Perpanjangan disetujui dan diperpanjang 1 tahun.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    public function sendEmail($id_member)
    {
        $member = Member::where('id_member', $id_member)->firstOrFail();

        Mail::to($member->email)->send(new MemberNotificationMail($member));

        return redirect()->back()->with('success', "Email telah dikirim ke {$member->email}");
    }

    public function sendEmailsByDate(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $members = Member::whereDate('tanggal_bergabung', $tanggal)->get();

        foreach ($members as $member) {
            Mail::to($member->email)->send(new MemberNotificationMail($member));
        }

        return redirect()->back()->with('success', "Email telah dikirim ke semua member pada tanggal $tanggal");
    }




    // public function toggleStatus($id_member)
    // {
    //     $member = Member::findOrFail($id_member);

    //     if ($member->status === 'OPE1') {
    //         $member->status = 'OPEN';
    //     } elseif ($member->status === 'OPEN') {
    //         $member->status = 'OPE1';
    //     }

    //     $member->save();

    //     return response()->json([
    //         'success' => true,
    //         'status' => $member->status,
    //     ]);
    // }


    // private function generateBarcode($id_member)
    // {
    //     $directory = public_path('storage/barcodes');
    //     if (!file_exists($directory)) {
    //         mkdir($directory, 0755, true);
    //     }

    //     $filename = $id_member . '.png';
    //     $fullPath = $directory . '/' . $filename;
    //     $publicPath = 'storage/barcodes/' . $filename;

    //     $generator = new BarcodeGeneratorPNG();
    //     $barcodeImage = $generator->getBarcode($id_member, $generator::TYPE_CODE_128);

    //     file_put_contents($fullPath, $barcodeImage);

    //     return $publicPath;
    // }
}
