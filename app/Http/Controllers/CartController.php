<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Photo;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf as Pdf;
use Illuminate\Support\Carbon;
// use PDF;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $user = Auth::user();

        $productId = $request->input('product_id'); // ✅ ini yang benar

        if (!$productId) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        $product = Product::find($productId);

        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak tersedia.');
        }

        $type = $request->input('type');
        $quantity = (int) $request->input('quantity', 1);

        // Cek apakah produk dengan type sama sudah di keranjang
        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->where('type', $type)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $productId,
                'type' => $type,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    // public function add(Request $request)
    // {
    //     $user = Auth::user();

    //     $productId = $request->input('id');


    //     // Validasi input
    //     if (!$productId) {
    //         return redirect()->back()->with('error', 'Produk tidak ditemukan.');
    //     }

    //     $product = Product::find($productId);

    //     if (!$product) {
    //         return redirect()->back()->with('error', 'Produk tidak tersedia.');
    //     }

    //     // Cek apakah produk sudah di keranjang
    //     $cartItem = Cart::where('user_id', $user->id)
    //         ->where('product_id', $productId)
    //         ->first();

    //     if ($cartItem) {
    //         $cartItem->quantity += 1;
    //         $cartItem->save();
    //     } else {
    //         Cart::create([
    //             'user_id' => $user->id,
    //             'product_id' => $productId,
    //             'type' => 'required',
    //             'quantity' => 1,
    //         ]);
    //     }

    //     return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    // }

    // public function add(Request $request)
    // {
    //     $user = Auth::user();

    //     $type = $request->input('type');
    //     $id = $request->input('id');

    //     // Validasi input
    //     if (!$type || !$id) {
    //         return redirect()->back()->with('error', 'Data tidak lengkap.');
    //     }

    //     // Tentukan model berdasarkan type
    //     if ($type === 'product') {
    //         $item = Product::find($id);
    //         $model_type = Product::class;
    //     } elseif ($type === 'photo') {
    //         $item = Photo::find($id);
    //         $model_type = Photo::class;
    //     } else {
    //         return redirect()->back()->with('error', 'Tipe item tidak valid.');
    //     }

    //     // Cek apakah item ada
    //     if (!$item) {
    //         return redirect()->back()->with('error', 'Item tidak ditemukan.');
    //     }

    //     // Cek apakah sudah ada di cart
    //     $cartItem = Cart::where('user_id', $user->id)
    //         ->where('item_id', $id)
    //         ->where('photo_id', $id)
    //         ->where('item_type', $model_type)
    //         ->first();

    //     if ($cartItem) {
    //         $cartItem->quantity += 1;
    //         $cartItem->save();
    //     } 
    //     else {
    //         Cart::create([
    //             'user_id' => $user->id,
    //             'item_id' => $id,
    //             'product_id' => $id,
    //             'item_type' => $model_type,
    //             'quantity' => 1,
    //         ]);
    //     }

    //     return redirect()->back()->with('success', 'Item berhasil ditambahkan ke keranjang.');
    // }

    // Method khusus untuk produk (untuk backward compatibility)
    // public function addProduct(Product $product)
    // {
    //     $user = Auth::user();

    //     $cartItem = Cart::where('user_id', $user->id)
    //         ->where('item_id', $product->id)
    //         ->where('product_id', $product->id)
    //         ->where('item_type', Product::class)
    //         ->first();

    //     if ($cartItem) {
    //         $cartItem->quantity += 1;
    //         $cartItem->save();
    //     } else {
    //         Cart::create([
    //             'user_id' => $user->id,
    //             'item_id' => $product->id,
    //             'item_type' => Product::class,
    //             'product_id' => $product->id,
    //             'quantity' => 1,
    //         ]);
    //     }

    //     return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    // }
    public function addProduct(Product $product)
    {
        $user = Auth::user();

        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $product->id,

                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }
    // Method khusus untuk foto
    // public function addPhoto(Photo $photo)
    // {
    //     $user = Auth::user();

    //     $cartItem = Cart::where('user_id', $user->id)
    //         ->where('photo_id', $photo->id)
    //         ->where('item_type', Photo::class)
    //         ->first();

    //     if ($cartItem) {
    //         $cartItem->quantity += 1;
    //         $cartItem->save();
    //     } else {
    //         Cart::create([
    //             'user_id' => $user->id,
    //             'photo_id' => $photo->id,
    //             'item_type' => Photo::class,
    //             'quantity' => 1,
    //         ]);
    //     }

    //     return redirect()->back()->with('success', 'Foto berhasil ditambahkan ke keranjang.');
    // }
    public function addPhoto(Photo $photo)
    {
        $user = Auth::user();

        $cartItem = Cart::where('user_id', $user->id)
            ->where('photo_id', $photo->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $user->id,
                'product_id' => null,
                'photo_id' => $photo->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Foto berhasil ditambahkan ke keranjang.');
    }
    // public function index()
    // {
    //     $cartItems = Auth::user()->carts()->with('product')->get();

    //     return view('frontend.cart.index', compact('cartItems'));
    // }

    public function index()
    {
        $user = Auth::user();

        $productCarts = Cart::where('user_id', $user->id)
            ->whereNotNull('product_id')
            ->with('product.images')
            ->get();

        $cartItems = collect();

        // foreach ($productCarts as $cart) {
        //     if ($cart->product) {
        //         $cartItems->push((object)[
        //             'cart_id' => $cart->id,
        //             'id' => $cart->product->id,
        //             'name' => $cart->product->name,
        //             'price' => $cart->product->price,
        //             'image' => $cart->product->image,
        //             'quantity' => $cart->quantity,
        //             'type' => 'product',
        //             'item' => $cart->product,
        //             'cart' => $cart
        //         ]);
        //     }
        // }
        foreach ($productCarts as $cart) {
            if ($cart->product) {
                // Cari image yang sesuai dengan type (misalnya: 'lowres' atau 'highres')
                $matchedImage = $cart->product->images
                    ->where('type', $cart->type)
                    ->first();

                // Jika tidak ada yang cocok, fallback ke null
                $image = $matchedImage ? $matchedImage->image_path : $cart->product->image;
                $price = $matchedImage ? $matchedImage->price : $cart->product->price;

                $cartItems->push((object)[
                    'cart_id' => $cart->id,
                    'id' => $cart->product->id,
                    'name' => $cart->product->name,
                    'price' => $price,
                    'image' => $image,
                    'quantity' => $cart->quantity,
                    'type' => $cart->type,
                    'item' => $cart->product,
                    'cart' => $cart
                ]);
            }
        }

        return view('frontend.cart.index', compact('cartItems'));
    }

    // public function index()
    // {
    //     $user = Auth::user();

    //     // Ambil cart items untuk produk
    //     $productCarts = Cart::where('user_id', $user->id)
    //         ->whereNotNull('product_id')
    //         ->with('product')
    //         ->get();

    //     // Ambil cart items untuk foto
    //     // $photoCarts = Cart::where('user_id', $user->id)
    //     //     ->whereNotNull('photo_id')
    //     //     ->with('photo')
    //     //     ->get();

    //     $cartItems = collect();

    //     // Tambahkan produk ke collection
    //     foreach ($productCarts as $cart) {
    //         if ($cart->product) { // Pastikan produk masih ada
    //             $cartItems->push((object)[
    //                 'cart_id' => $cart->id,
    //                 'id' => $cart->product->id,
    //                 'name' => $cart->product->name,
    //                 'price' => $cart->product->price,
    //                 'image' => $cart->product->image,
    //                 'quantity' => $cart->quantity,
    //                 'type' => 'product',
    //                 'item' => $cart->product,
    //                 'cart' => $cart
    //             ]);
    //         }
    //     }

    //     // Tambahkan foto ke collection
    //     // foreach ($photoCarts as $cart) {
    //     //     if ($cart->photo) { // Pastikan foto masih ada
    //     //         $cartItems->push((object)[
    //     //             'cart_id' => $cart->id,
    //     //             'id' => $cart->photo->id,
    //     //             'name' => $cart->photo->name,
    //     //             'price' => $cart->photo->harga_image_highres,
    //     //             'image' => $cart->photo->cover,
    //     //             'quantity' => $cart->quantity,
    //     //             'type' => 'photo',
    //     //             'item' => $cart->photo,
    //     //             'cart' => $cart
    //     //         ]);
    //     //     }
    //     // }

    //     return view('frontend.cart.index', compact('cartItems'));
    // }
    // Di CartController
    // public function updateQuantity(Request $request, $id)
    // {
    //     $cart = Auth::user()->carts()->findOrFail($id);

    //     $request->validate([
    //         'quantity' => 'required|integer|min:1'
    //     ]);

    //     $cart->update([
    //         'quantity' => $request->quantity
    //     ]);

    //     return response()->json(['success' => true]);
    // }
    public function updateQuantity(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);

        // Pastikan user hanya bisa update cart-nya sendiri
        if ($cart->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $quantity = (int) $request->input('quantity');

        if ($quantity <= 0) {
            $cart->delete();
            return response()->json(['success' => true, 'message' => 'Item dihapus dari keranjang']);
        }

        $cart->quantity = $quantity;
        $cart->save();

        return response()->json(['success' => true, 'message' => 'Kuantitas berhasil diupdate']);
    }
    public function remove($id)
    {
        $cart = Cart::findOrFail($id);

        // Pastikan user hanya bisa hapus cart-nya sendiri
        if ($cart->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized');
        }

        $cart->delete();

        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang');
    }
    public function store(Request $request)
    {
        $request->validate([
            'transaction_ids' => 'required|string',
            'proof_of_payment' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $ids = explode(',', $request->input('transaction_ids'));

        $transactions = Transaction::whereIn('id', $ids)->get();

        if ($transactions->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Transaksi tidak ditemukan.');
        }

        // Simpan file langsung ke folder public/proofs
        $file = $request->file('proof_of_payment');
        $filename = time() . '_' . $file->getClientOriginalName();
        $destinationPath = public_path('proofs');
        $file->move($destinationPath, $filename);

        // Simpan path ke database
        $filePath = 'proofs/' . $filename;


        // Update semua transaksi
        foreach ($transactions as $transaction) {
            $transaction->update([
                'proof_of_payment' => $filePath,
                'status' => 'proses',
            ]);
        }

        // return redirect()->route('checkout.success')->with('success', 'Pembayaran berhasil diproses.');

        return redirect()->route('home')->with('success', 'Pembayaran berhasil dikirim. Menunggu konfirmasi.');
    }
    public function pending()
    {
        $today = Carbon::today();
        $user = Auth::user();

        // Ambil transaksi pending hari ini untuk user yang login
        $transactions = Transaction::where('user_id', $user->id)
            ->where('status', 'pending')
            ->whereDate('updated_at', $today)
            ->with(['product', 'user'])
            ->get()
            ->groupBy('transaction_code'); // Grup berdasarkan kode transaksi

        // Format data untuk ditampilkan
        $groupedOrders = [];
        foreach ($transactions as $transactionCode => $items) {
            $totalAmount = $items->sum('amount');
            $totalQty = $items->sum('qty');


            $groupedOrders[] = [
                'transaction_code' => $transactionCode,
                'items' => $items,
                'total_amount' => $totalAmount,
                'total_qty' => $totalQty,
                'updated_at' => $items->first()->updated_at,

            ];
        }

        // Urutkan berdasarkan yang terbaru
        usort($groupedOrders, function ($a, $b) {
            return $b['updated_at'] <=> $a['updated_at'];
        });

        return view('frontend.cart.pending', compact('groupedOrders'));
    }

    public function store_pending(Request $request)
    {
        $request->validate([
            'transaction_code' => 'required|string',
            'proof_of_payment' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();
        $transactionCode = $request->input('transaction_code');

        // Pastikan transaksi milik user yang login
        $transactions = Transaction::where('transaction_code', $transactionCode)
            ->where('user_id', $user->id)
            ->where('status', 'pending')
            ->whereDate('updated_at', Carbon::today())
            ->get();

        if ($transactions->isEmpty()) {
            return redirect()->route('cart.pending')->with('error', 'Transaksi tidak ditemukan atau sudah kadaluarsa.');
        }

        // Simpan file bukti pembayaran
        if ($request->hasFile('proof_of_payment')) {
            $file = $request->file('proof_of_payment');
            $filename = 'proof_' . $transactionCode . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/proofs', $filename);
            $filePath = 'proofs/' . $filename;
        }

        // Update semua transaksi dengan kode yang sama
        Transaction::where('transaction_code', $transactionCode)
            ->where('user_id', $user->id)
            ->update([
                'proof_of_payment' => $filePath,
                'status' => 'proses',
                'updated_at' => now()
            ]);

        return redirect()->route('cart.pending')->with('success', 'Bukti pembayaran berhasil diunggah. Pesanan akan segera diproses.');
    }


    // public function process()
    // {
    //     $user = Auth::user();

    //     // Ambil transaksi dengan status proses untuk user yang login
    //     $transactions = Transaction::where('user_id', $user->id)
    //         ->where('status', 'proses')
    //         ->with(['product', 'user', 'photo'])
    //         ->get()
    //         ->groupBy('transaction_code'); // Grup berdasarkan kode transaksi

    //     // Format data untuk ditampilkan
    //     $groupedOrders = [];
    //     foreach ($transactions as $transactionCode => $items) {
    //         $totalAmount = $items->sum('amount');
    //         $totalQty = $items->sum('qty');
    //         $proofOfPayment = $items->first()->proof_of_payment;
    //         $photo = $items->firstWhere('photo_id', '!=', null)?->photo;
    //         $groupedOrders[] = [
    //             'transaction_code' => $transactionCode,
    //             'items' => $items,
    //             'total_amount' => $totalAmount,
    //             'total_qty' => $totalQty,
    //             'updated_at' => $items->first()->updated_at,
    //             'proof_of_payment' => $proofOfPayment,
    //             'photo' => $photo
    //         ];
    //     }

    //     // Urutkan berdasarkan yang terbaru
    //     usort($groupedOrders, function ($a, $b) {
    //         return $b['updated_at'] <=> $a['updated_at'];
    //     });

    //     return view('frontend.cart.process', compact('groupedOrders'));
    // }
    public function process()
    {
        $user = Auth::user();

        // Ambil transaksi dengan status proses untuk user yang login
        $transactions = Transaction::where('user_id', $user->id)
            ->where('status', 'proses')
            ->with(['product', 'user'])
            ->get()
            ->groupBy('transaction_code'); // Grup berdasarkan kode transaksi

        // Format data untuk ditampilkan
        $groupedOrders = [];
        foreach ($transactions as $transactionCode => $items) {
            $totalAmount = $items->sum('amount');
            $totalQty = $items->sum('qty');
            $proofOfPayment = $items->first()->proof_of_payment;
            // $photo = $items->firstWhere('photo_id', '!=', null)?->photo;

            $groupedOrders[] = [
                'transaction_code' => $transactionCode,
                'items' => $items->map(function ($item) {
                    // Handle jika product tidak ditemukan
                    if (!$item->product) {
                        $item->product = new \stdClass();
                        $item->product->name = 'Produk tidak tersedia';
                        $item->product->price = 0;
                        $item->product->image = null;
                    }
                    // Handle jika photo tidak ditemukan
                    // if (!$item->photo) {
                    //     $item->photo = new \stdClass();
                    //     $item->photo->title = 'Foto tidak tersedia';
                    //     $item->photo->cover = null; // atau isi default image
                    // }
                    return $item;
                }),
                'total_amount' => $totalAmount,
                'total_qty' => $totalQty,
                'updated_at' => $items->first()->updated_at,
                'proof_of_payment' => $proofOfPayment,
                // 'photo' => $photo,
                'has_deleted_product' => $items->contains(function ($item) {
                    return empty($item->product) || !isset($item->product->id);
                })
            ];
        }

        // Urutkan berdasarkan yang terbaru
        usort($groupedOrders, function ($a, $b) {
            return $b['updated_at'] <=> $a['updated_at'];
        });

        return view('frontend.cart.process', compact('groupedOrders'));
    }



    public function done()
    {
        $user = Auth::user();

        // Ambil transaksi dengan status done untuk user yang login
        $transactions = Transaction::where('user_id', $user->id)
            ->where('status', 'done')
            // ->with(['product', 'user'])
            ->with(['product.reviews' => function ($q) use ($user) {
                $q->where('user_id', $user->id);
            }, 'user'])

            ->get()
            ->groupBy('transaction_code'); // Grup berdasarkan kode transaksi

        // Format data untuk ditampilkan
        $completedOrders = [];
        foreach ($transactions as $transactionCode => $items) {
            $totalAmount = $items->sum('amount');
            $totalQty = $items->sum('qty');
            $completedAt = $items->first()->updated_at;

            $completedOrders[] = [
                'transaction_code' => $transactionCode,
                'items' => $items,
                'total_amount' => $totalAmount,
                'total_qty' => $totalQty,
                'completed_at' => $completedAt,
                'delivery_info' => $items->first()->delivery_info // jika ada info pengiriman
            ];
        }

        // Urutkan berdasarkan yang terbaru
        usort($completedOrders, function ($a, $b) {
            return $b['completed_at'] <=> $a['completed_at'];
        });

        return view('frontend.cart.done', compact('completedOrders'));
    }
    public function submitReview(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Cegah review ganda
        $existing = Review::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($existing) {
            return back()->with('error', 'Anda sudah memberi ulasan untuk produk ini.');
        }

        Review::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'content' => $request->content,
            'rating' => $request->rating,
        ]);

        return back()->with('success', 'Ulasan berhasil dikirim!');
    }

    public function downloadInvoice($transactionCode)
    {
        $user = Auth::user();

        // Validasi transaksi
        $transactions = Transaction::where('transaction_code', $transactionCode)
            ->where('user_id', $user->id)
            ->where('status', 'done')
            ->with(['product', 'user'])
            ->get();

        if ($transactions->isEmpty()) {
            return redirect()->route('cart.done')->with('error', 'Transaksi tidak ditemukan atau tidak dapat mengunduh invoice.');
        }

        // Format data untuk invoice
        $invoiceData = [
            'transaction_code' => $transactionCode,
            'customer_name' => $user->name,
            'customer_email' => $user->email,
            'date' => $transactions->first()->updated_at->format('d F Y H:i'),
            'items' => $transactions->map(function ($item) {
                return [
                    'product_name' => $item->product->name,
                    'price' => $item->product->price,
                    'quantity' => $item->qty,
                    'subtotal' => $item->amount
                ];
            }),
            'total_amount' => $transactions->sum('amount'),
            'company_name' => env('APP_NAME', 'Toko Saya'),
            'company_address' => 'Jl. Contoh No. 123, Kota Anda',
            'company_phone' => '(021) 12345678'
        ];


        // Generate PDF invoice
        $pdf = Pdf::loadView('frontend.cart.invoce_template', $invoiceData);

        // Nama file invoice
        $filename = 'invoice_' . $transactionCode . '.pdf';

        // Download file
        return $pdf->download($filename);
    }
}
