<?php

namespace App\Http\Controllers;

use App\Models\KabupatenKota;
use App\Models\Member;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserProfileController extends Controller
{
    // public function index()
    // {
    //     // Ambil data user yang sedang login
    //     $user = auth()->user();

    //     // Ambil alamat user jika ada relasi
    //     $addresses = $user->addresses ?? [];

    //     return view('frontend.profile.index', compact('user', 'addresses'));
    // }
    public function index()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();

        // Ambil data kota untuk dropdown
        $cities = KabupatenKota::orderBy('name', 'asc')->get();

        return view('frontend.profile.index', compact('user', 'cities'));
    }
    // public function upgradeToMember(Request $request)
    // {
    //     $user = Auth::user();

    //     $request->validate([
    //         'bukti_tf' => 'required|image|max:2048',
    //         'payment_method' => 'required|string|max:50',
    //     ]);

    //     // Upload bukti transfer
    //     $path = $request->file('bukti_tf')->store('bukti_tf', 'public');
    //     $idMember = $this->generateIdMember($request->kota_id, $request->tanggal_bergabung);
    //     // Buat Member
    //     $member = Member::create([
    //         'id_member' => $idMember,
    //         'user_id' => $user->id,
    //         'name' => $user->name,
    //         'email' => $user->email,
    //         'phone' => $user->contact,
    //         'photo' => $user->photo,
    //         'kota_id' => $user->kota_id,
    //         'status' => 'OPE1',
    //         'barcode_path' => null,
    //         'bukti_tf' => $path,
    //         'tanggal_bergabung' => now(),
    //         'payment_method' => $request->payment_method,
    //     ]);

    //     // Update role user
    //     $user->role = 'member';
    //     $user->save();

    //     return redirect()->route('profile.index')->with('success', 'Berhasil upgrade menjadi member.');
    // }
    public function upgradeToMember(Request $request)
    {
        $user = Auth::user();

        // Validasi bahwa user belum menjadi member
        if ($user->role === 'member') {
            return redirect()->back()->with('error', 'Anda sudah menjadi member.');
        }

        $request->validate([
            'bukti_tf' => 'required|image|max:2048',
            'payment_method' => 'required|string|max:50',
            'kota_id' => 'required|exists:kabupaten_kota,id',
            'terms' => 'accepted'
        ]);

        try {
            // Upload bukti transfer
            $path = $request->file('bukti_tf')->store('bukti_tf', 'public');

            // ✅ Tentukan tanggal bergabung & berakhir
            $tanggalBergabung = now();
            $tanggalBerakhir = Carbon::parse($tanggalBergabung)->addYear();

            // Generate ID Member
            $idMember = $this->generateIdMember($request->kota_id, $tanggalBergabung);

            // Buat Member
            $member = Member::create([
                'id_member' => $idMember,
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->contact,
                'photo' => $user->photo,
                'kota_id' => $user->kota_id,
                'status' => 'OPE1', // atau status awal lainnya
                'barcode_path' => null,
                'bukti_tf' => $path,
                'tanggal_bergabung' => $tanggalBergabung,
                'tanggal_berakhir' => $tanggalBerakhir,
                'payment_method' => $request->payment_method,
            ]);

            // Update role user
            $user->role = 'member';
            $user->save();

            return redirect()->route('profile.index')->with('success', 'Berhasil upgrade menjadi member. Status akan diverifikasi oleh admin.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal upgrade member: ' . $e->getMessage());
        }
    }
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
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'contact' => 'nullable|string|max:20',
            'ttl' => 'nullable|date',
            'kelamin' => 'nullable|in:male,female',
            'kota_id' => 'nullable|exists:kabupaten_kota,id',
            'password' => 'nullable|confirmed|min:8',
        ];

        $messages = [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Please enter a valid email address',
            'email.unique' => 'This email is already taken',
            'contact.max' => 'Contact number cannot exceed 20 characters',
            'ttl.date' => 'Please enter a valid date',
            'kelamin.in' => 'Please select a valid gender',
            'kota_id.exists' => 'Please select a valid city',
            'password.min' => 'Password must be at least 8 characters',
            'password.confirmed' => 'Password confirmation does not match',
        ];

        $request->validate($rules, $messages);

        try {
            // Update data user
            $updateData = [
                'name' => $request->name,
                'email' => $request->email,
                'contact' => $request->contact,
                'ttl' => $request->ttl,
                'kelamin' => $request->kelamin,
                'kota_id' => $request->kota_id,
            ];

            // Jika password diisi, update password
            if ($request->filled('password')) {
                $updateData['password'] = Hash::make($request->password);
            }

            // Update user
            $user->update($updateData);

            return redirect()->route('profile.index')->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating profile. Please try again.');
        }
    }
    public function updateAvatar(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'photo.required' => 'Please select a profile picture.',
            'photo.image' => 'The file must be an image.',
            'photo.mimes' => 'Only jpeg, png, jpg, gif are allowed.',
            'photo.max' => 'Image size must be less than 2MB.',
        ]);

        // Pastikan folder public/avatars ada
        $destinationPath = public_path('avatars');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        // Hapus foto lama kalau ada
        if ($user->photo && file_exists(public_path($user->photo))) {
            unlink(public_path($user->photo));
        }

        // Simpan file baru
        $file = $request->file('photo');
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $fileName);

        // Simpan path relatif ke DB
        $user->update([
            'photo' => 'avatars/' . $fileName
        ]);

        return redirect()->route('profile.index')->with('success', 'Profile picture updated successfully!');
    }


    private function groupTransactions($transactions)
    {
        $result = [];

        foreach ($transactions as $transactionCode => $items) {
            $result[] = [
                'transaction_code' => $transactionCode,
                'items' => $items,
                'total_amount' => $items->sum('amount'),
                'total_qty' => $items->sum('qty'),
                'updated_at' => $items->first()->updated_at,
                'proof_of_payment' => $items->first()->proof_of_payment ?? null,
            ];
        }

        // Urutkan berdasarkan terbaru
        usort($result, function ($a, $b) {
            return $b['updated_at'] <=> $a['updated_at'];
        });

        return $result;
    }
}
