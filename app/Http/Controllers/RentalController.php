<?php

namespace App\Http\Controllers;

use App\Models\CategoriBarang;
use App\Models\Item;
use App\Models\Rental;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
// use Illuminate\Support\Carbon;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Dompdf\Dompdf;
use Dompdf\Options;

class RentalController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $rentals = Rental::latest()->paginate(10);
        return view('admin.rental.index', compact('rentals', 'user'));
    }
    // public function create()
    // {
    //     $categories = CategoriBarang::with(['items' => function ($query) {
    //         $query->where('status', 'available');
    //     }])->get();

    //     return view('admin.rental.create', compact('categories'));
    // }
    public function create()
    {
        $items = Item::where('quantity', '>', 0)
            ->select('id', 'name', 'daily_price', 'quantity', 'description')
            ->orderBy('name')
            ->get();
        return view('admin.rental.create', compact('items'));
    }
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'renter_name' => 'required|max:100',
    //         'renter_phone' => 'required|max:20',
    //         'start_date' => 'required|date|after_or_equal:today',
    //         'end_date' => 'required|date|after:start_date',
    //         'items' => 'required|array|min:1',
    //         'items.*.id' => 'required|exists:items,id',
    //         'items.*.quantity' => 'required|integer|min:1',
    //         'renter_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    //         'document' => 'required|file|mimes:pdf,jpeg,png,jpg|max:2048'
    //     ]);

    //     // Hitung total harga
    //     $totalPrice = 0;
    //     $rentalItems = [];
    //     $startDate = Carbon::parse($request->start_date);
    //     $endDate = Carbon::parse($request->end_date);
    //     $days = $endDate->diffInDays($startDate) + 1;

    //     foreach ($request->items as $selectedItem) {
    //         $item = Item::findOrFail($selectedItem['id']);
    //         $subTotal = $item->daily_price * $selectedItem['quantity'] * $days;

    //         $rentalItems[] = [
    //             'item_id' => $item->id,
    //             'quantity' => $selectedItem['quantity'],
    //             'daily_price' => $item->daily_price,
    //             'sub_total' => $subTotal
    //         ];

    //         $totalPrice += $subTotal;
    //     }

    //     // Upload file
    //     $renterPhotoPath = $request->file('renter_photo')->store('renter-photos', 'public');
    //     $documentPath = $request->file('document')->store('rental-documents', 'public');

    //     // Buat penyewaan
    //     $rental = Rental::create([
    //         'user_id' => auth()->id(),
    //         'category_id' => $request->category_id, 
    //         'renter_name' => $request->renter_name,
    //         'renter_phone' => $request->renter_phone,
    //         'renter_photo_path' => $renterPhotoPath,
    //         'document_path' => $documentPath,
    //         'start_date' => $request->start_date,
    //         'end_date' => $request->end_date,
    //         'total_price' => $totalPrice,
    //         'status' => 'pending'
    //     ]);

    //     // Simpan item yang disewa
    //     $rental->rentalItems()->createMany($rentalItems);

    //     // Update status barang
    //     foreach ($request->items as $selectedItem) {
    //         Item::where('id', $selectedItem['id'])
    //             ->decrement('quantity', $selectedItem['quantity']);
    //     }

    //     return redirect()->route('rentals.show', $rental->id)
    //         ->with('success', 'Penyewaan berhasil dibuat. Menunggu persetujuan admin.');
    // }
    public function getItems(Request $request)
    {
        $items = Item::where('quantity', '>', 0)
            ->select('id', 'name', 'daily_price', 'quantity', 'description')
            ->get();

        return response()->json($items);
    }
    public function checkItemAvailability(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $item = Item::findOrFail($request->item_id);

        // Hitung item yang sedang disewa pada periode yang sama
        $rentedQuantity = DB::table('rental_items')
            ->join('rentals', 'rental_items.rental_id', '=', 'rentals.id')
            ->where('rental_items.item_id', $request->item_id)
            ->where('rentals.status', '!=', 'returned')
            ->where('rentals.status', '!=', 'cancelled')
            ->where(function ($query) use ($request) {
                $query->whereBetween('rentals.start_date', [$request->start_date, $request->end_date])
                    ->orWhereBetween('rentals.end_date', [$request->start_date, $request->end_date])
                    ->orWhere(function ($subQuery) use ($request) {
                        $subQuery->where('rentals.start_date', '<=', $request->start_date)
                            ->where('rentals.end_date', '>=', $request->end_date);
                    });
            })
            ->sum('rental_items.quantity');

        $availableQuantity = $item->quantity - $rentedQuantity;

        return response()->json([
            'available' => $availableQuantity >= $request->quantity,
            'available_quantity' => max(0, $availableQuantity),
            'requested_quantity' => $request->quantity,
            'item_name' => $item->name,
            'daily_price' => $item->daily_price
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'renter_name' => 'required|max:100',
            'renter_phone' => 'required|max:20',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'renter_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'document' => 'required|file|mimes:pdf,jpeg,png,jpg|max:2048',
            'ttd_peminjam' => 'nullable|string',
        ]);
        $request['ttd_peminjam'] = $request->filled('ttd_peminjam') && $request->input('ttd_peminjam') !== ''
            ? $this->saveSignature($request->input('ttd_peminjam'), 'ALS', $request->renter_name)
            : null;
        // Hitung total harga
        $totalPrice = 0;
        $rentalItems = [];
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $days = $endDate->diffInDays($startDate) + 1;

        foreach ($request->items as $selectedItem) {
            $item = Item::findOrFail($selectedItem['id']);

            // Validasi stok cukup
            if ($item->quantity < $selectedItem['quantity']) {
                return back()->withErrors(['items' => 'Stok ' . $item->name . ' tidak mencukupi']);
            }

            $subTotal = $item->daily_price * $selectedItem['quantity'] * $days;

            $rentalItems[] = [
                'item_id' => $item->id,
                'quantity' => $selectedItem['quantity'],
                'daily_price' => $item->daily_price,
                'sub_total' => $subTotal
            ];

            $totalPrice += $subTotal;
        }

        // Upload file
        // $renterPhotoPath = $request->file('renter_photo')->store('renter-photos', 'public');
        // $documentPath = $request->file('document')->store('rental-documents', 'public');
        // Upload foto penyewa
        if ($request->hasFile('renter_photo')) {
            $renterPhoto = $request->file('renter_photo');
            $renterPhotoName = time() . '_' . uniqid() . '.' . $renterPhoto->getClientOriginalExtension();
            $renterPhoto->move(public_path('renter_photo'), $renterPhotoName);
            $renterPhotoPath = 'renter_photo/' . $renterPhotoName;
        }

        // Upload dokumen
        if ($request->hasFile('document')) {
            $document = $request->file('document');
            $documentName = time() . '_' . uniqid() . '.' . $document->getClientOriginalExtension();
            $document->move(public_path('rental_document'), $documentName);
            $documentPath = 'rental_document/' . $documentName;
        }

        // Buat penyewaan
        $rental = Rental::create([
            'user_id' => auth()->id(),
            'renter_name' => $request->renter_name,
            'renter_phone' => $request->renter_phone,
            'renter_photo_path' => $renterPhotoPath,
            'document_path' => $documentPath,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'ttd_peminjam' => $request->ttd_peminjam,
        ]);

        // Simpan item yang disewa
        $rental->rentalItems()->createMany($rentalItems);

        // Update stok barang
        foreach ($request->items as $selectedItem) {
            Item::where('id', $selectedItem['id'])
                ->decrement('quantity', $selectedItem['quantity']);
        }

        return redirect()->route('rentals.index', $rental->id)
            ->with('success', 'Penyewaan berhasil dibuat. Menunggu persetujuan admin.');
    }
    private function saveSignature($items, $prefix, $renter_name)
    {
        if (empty($items)) {
            Log::info("Empty signature data");
            return null;
        }
        if (filter_var($items, FILTER_VALIDATE_URL)) {
            return basename($items);
        }
        if (!str_contains($items, 'data:image/png;base64,')) {
            return $items;
        }
        try {
            $folderPath = public_path('tanda_tangan/');
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0775, true);
            }

            $image_parts = explode(";base64,", $items);
            $image_base64 = base64_decode($image_parts[1]);

            $dateString = date('dmY');
            $sanitized_name = preg_replace('/\s+/', '_', strtolower($renter_name));
            $fileName = "{$prefix}_field({$sanitized_name}){$dateString}.png";
            $filePath = $folderPath . $fileName;

            file_put_contents($filePath, $image_base64);

            // simpan path relatif di DB, biar sama dengan renter_photo & document
            return 'tanda_tangan/' . $fileName;
        } catch (\Exception $e) {
            Log::error("Error saving signature: " . $e->getMessage());
            return null;
        }
    }

    public function destroy($id)
    {
        $rental = Rental::findOrFail($id);

        // Kembalikan stok barang
        foreach ($rental->rentalItems as $rentalItem) {
            Item::where('id', $rentalItem->item_id)
                ->increment('quantity', $rentalItem->quantity);
        }

        // Hapus file renter_photo
        if ($rental->renter_photo_path && file_exists(public_path($rental->renter_photo_path))) {
            unlink(public_path($rental->renter_photo_path));
        }

        // Hapus file document
        if ($rental->document_path && file_exists(public_path($rental->document_path))) {
            unlink(public_path($rental->document_path));
        }

        // Hapus ttd peminjam
        if ($rental->ttd_peminjam && file_exists(public_path('tanda_tangan/' . $rental->ttd_peminjam))) {
            unlink(public_path('tanda_tangan/' . $rental->ttd_peminjam));
        }

        // Hapus relasi rental_items
        $rental->rentalItems()->delete();

        // Hapus rental
        $rental->delete();

        return redirect()->route('rentals.index')
            ->with('success', 'Penyewaan berhasil dihapus.');
    }
    public function edit($id)
    {
        $rental = Rental::with('rentalItems.item')->findOrFail($id);
        $items = Item::where('quantity', '>', 0)
            ->orWhereIn('id', $rental->rentalItems->pluck('item_id'))
            ->select('id', 'name', 'daily_price', 'quantity', 'description')
            ->orderBy('name')
            ->get();

        return view('admin.rental.edit', compact('rental', 'items'));
    }

    public function update(Request $request, $id)
    {
        $rental = Rental::with('rentalItems')->findOrFail($id);

        $request->validate([
            'renter_name' => 'required|max:100',
            'renter_phone' => 'required|max:20',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'renter_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'document' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:2048',
            'ttd_peminjam' => 'nullable|string',
        ]);

        // Handle signature
        $ttdPeminjam = $rental->ttd_peminjam;
        if ($request->filled('ttd_peminjam') && $request->input('ttd_peminjam') !== '') {
            $ttdPeminjam = $this->saveSignature($request->input('ttd_peminjam'), 'ALS', $request->renter_phone);
        }

        // Hitung total harga
        $totalPrice = 0;
        $rentalItems = [];
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $days = $endDate->diffInDays($startDate) + 1;

        // Kembalikan stok barang yang sebelumnya dipinjam
        foreach ($rental->rentalItems as $rentalItem) {
            Item::where('id', $rentalItem->item_id)
                ->increment('quantity', $rentalItem->quantity);
        }

        // Validasi stok dan hitung total harga baru
        foreach ($request->items as $selectedItem) {
            $item = Item::findOrFail($selectedItem['id']);

            // Validasi stok cukup
            if ($item->quantity < $selectedItem['quantity']) {
                return back()->withErrors(['items' => 'Stok ' . $item->name . ' tidak mencukupi']);
            }

            $subTotal = $item->daily_price * $selectedItem['quantity'] * $days;

            $rentalItems[] = [
                'item_id' => $item->id,
                'quantity' => $selectedItem['quantity'],
                'daily_price' => $item->daily_price,
                'sub_total' => $subTotal
            ];

            $totalPrice += $subTotal;
        }

        // Handle file uploads
        $renterPhotoPath = $rental->renter_photo_path;
        if ($request->hasFile('renter_photo')) {
            // Hapus foto lama jika ada
            if ($renterPhotoPath && file_exists(public_path($renterPhotoPath))) {
                unlink(public_path($renterPhotoPath));
            }

            $renterPhoto = $request->file('renter_photo');
            $renterPhotoName = time() . '_' . uniqid() . '.' . $renterPhoto->getClientOriginalExtension();
            $renterPhoto->move(public_path('renter_photo'), $renterPhotoName);
            $renterPhotoPath = 'renter_photo/' . $renterPhotoName;
        }

        $documentPath = $rental->document_path;
        if ($request->hasFile('document')) {
            // Hapus dokumen lama jika ada
            if ($documentPath && file_exists(public_path($documentPath))) {
                unlink(public_path($documentPath));
            }

            $document = $request->file('document');
            $documentName = time() . '_' . uniqid() . '.' . $document->getClientOriginalExtension();
            $document->move(public_path('rental_document'), $documentName);
            $documentPath = 'rental_document/' . $documentName;
        }

        // Update penyewaan
        $rental->update([
            'renter_name' => $request->renter_name,
            'renter_phone' => $request->renter_phone,
            'renter_photo_path' => $renterPhotoPath,
            'document_path' => $documentPath,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_price' => $totalPrice,
            'ttd_peminjam' => $ttdPeminjam,
        ]);

        // Hapus item lama dan tambahkan yang baru
        $rental->rentalItems()->delete();
        $rental->rentalItems()->createMany($rentalItems);

        // Update stok barang baru
        foreach ($request->items as $selectedItem) {
            Item::where('id', $selectedItem['id'])
                ->decrement('quantity', $selectedItem['quantity']);
        }

        return redirect()->route('rentals.index')
            ->with('success', 'Penyewaan berhasil diperbarui.');
    }
    public function show(Rental $rental)
    {
        $rental->load(['rentalItems.item', 'user']);
        return view('admin.rental.show', compact('rental'));
    }
    public function approve(Rental $rental)
    {
        // cek role user
        $user = Auth::user();

        if (!in_array($user->role, ['admin', 'member']) && !in_array($user->subdep, ['perkap', 'oprasinal'])) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk approve.');
        }

        if ($rental->status === 'pending') {
            $rental->update(['status' => 'approved']);
            return redirect()->route('rentals.show', $rental->id)->with('success', 'Rental berhasil di-approve.');
        }

        return redirect()->back()->with('error', 'Rental sudah di-approve sebelumnya.');
    }

    public function downloadPdf(Rental $rental)
    {
        try {
            // Set longer execution time and more memory
            set_time_limit(300);
            ini_set('memory_limit', '1024M');

            // Load necessary relationships
            $rental->load(['rentalItems.item', 'user']);

            // Configure DomPDF with optimized settings
            $options = new Options();
            $options->set('isRemoteEnabled', false); // Disable remote content loading
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isPhpEnabled', false); // Disable PHP for security
            $options->set('debugKeepTemp', false);
            $options->set('debugCss', false);
            $options->set('debugLayout', false);
            $options->set('debugLayoutLines', false);
            $options->set('debugLayoutBlocks', false);
            $options->set('debugLayoutInline', false);
            $options->set('debugLayoutPaddingBox', false);

            // Create DomPDF instance
            $dompdf = new Dompdf($options);

            // Use the PDF-optimized view instead of the original show view
            $html = view('admin.rental.show', compact('rental'))->render();

            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');

            // Render the PDF
            $dompdf->render();

            // Return the PDF stream
            return $dompdf->stream("rental-nota-{$rental->id}.pdf", [
                'Attachment' => false // Show in browser instead of forcing download
            ]);
        } catch (\Exception $e) {
            // Log the error
            Log::error('PDF Download Error: ' . $e->getMessage(), [
                'rental_id' => $rental->id,
                'user_id' => auth()->id()
            ]);

            // Return back with error message
            return back()->with('error', 'Gagal mengunduh PDF. Silakan coba lagi.');
        }
    }
    public function downloadPdfAlternative(Rental $rental)
    {
        try {
            $rental->load(['rentalItems.item', 'user']);

            $pdf = PDF::loadView('admin.rental.pdf-show', compact('rental'))
                ->setPaper('A4', 'portrait')
                ->setOptions([
                    'isRemoteEnabled' => false,
                    'isHtml5ParserEnabled' => true,
                    'isPhpEnabled' => false,
                    'debugKeepTemp' => false,
                ]);

            return $pdf->stream("rental-nota-{$rental->id}.pdf");
        } catch (\Exception $e) {
            Log::error('PDF Download Error: ' . $e->getMessage());
            return back()->with('error', 'Gagal mengunduh PDF. Silakan coba lagi.');
        }
    }
}
