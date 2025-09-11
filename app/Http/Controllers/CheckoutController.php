<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    // public function form($id)
    // {
    //     $transaction = Transaction::findOrFail($id);
    //     $product = $transaction->product;

    //     $user = auth()->user();
    //     return view('frontend.produk.form', compact('product', 'user', 'transaction' ));
    // }
    public function form($id)
    {
        $transaction = Transaction::findOrFail($id);
        $product = $transaction->product;
        $user = auth()->user();

        // Ambil harga dari product_images berdasarkan type transaksi
        $productImage = $product->images()->where('type', $transaction->type)->first();
        $price = $productImage ? $productImage->price : $product->price; // fallback jika tidak ditemukan

        return view('frontend.produk.form', compact('product', 'user', 'transaction', 'price'));
    }

    public function photoform($id)
    {
        $transaction = Transaction::findOrFail($id);
        $photo = $transaction->photo;
        $user = auth()->user();
        return view('frontend.photos.formphoto', compact('user', 'transaction', 'photo'));
    }
    public function store(Request $request, $id)
    {
        $request->validate([
            'proof_of_payment' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $transaction = Transaction::findOrFail($id);

        $file = $request->file('proof_of_payment');
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('proofs'), $filename);
        $path = 'proofs/' . $filename;

        $transaction->update([
            'proof_of_payment' => $path,
            'status' => 'proses',
        ]);

        return redirect()->route('checkout.success', $transaction->id);
    }
    public function storephoto(Request $request, $id)
    {
        $request->validate([
            'proof_of_payment' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $transaction = Transaction::findOrFail($id);

        $file = $request->file('proof_of_payment');
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('proofs'), $filename);
        $path = 'proofs/' . $filename;

        $transaction->update([
            'proof_of_payment' => $path,
            'status' => 'proses',
        ]);

        return redirect()->route('checkoutphoto.success', $transaction->id);
    }

    public function success($id)
    {
        $user = auth()->user();
        // $transaction = Transaction::findOrFail($id);
        $transaction = Transaction::with('product')->findOrFail($id);
        return view('frontend.produk.checkout_success', compact('transaction', 'user'));
    }
    public function successphoto($id)
    {
        $user = auth()->user();
        // $transaction = Transaction::findOrFail($id);
        $transaction = Transaction::with('photo')->findOrFail($id);
        return view('frontend.photos.checkout_photo_succes', compact('transaction', 'user'));
    }
    // public function multiStore(Request $request)
    // {
    //     $user = Auth::user();

    //     // Validasi apakah ada item yang dipilih
    //     if (!$request->has('cart_items')) {
    //         return redirect()->route('cart.index')->with('error', 'Pilih minimal 1 produk untuk checkout.');
    //     }

    //     $selectedIds = $request->input('cart_items');

    //     // Ambil cart item berdasarkan ID dan user_id
    //     $cartItems = Cart::with('product')
    //         ->where('user_id', $user->id)
    //         ->whereIn('id', $selectedIds)
    //         ->get();

    //     if ($cartItems->isEmpty()) {
    //         return redirect()->route('cart.index')->with('error', 'Tidak ditemukan produk yang dipilih.');
    //     }

    //     return view('frontend.cart.checkout', compact('cartItems'));
    // }
    public function multiStore(Request $request)
    {
        $user = Auth::user();

        // Validasi apakah ada item yang dipilih
        if (!$request->has('cart_items')) {
            return redirect()->route('cart.index')->with('error', 'Pilih minimal 1 produk untuk checkout.');
        }

        $selectedIds = $request->input('cart_items');

        // Ambil cart item berdasarkan ID dan user_id
        $cartItems = Cart::with('product')
            ->where('user_id', $user->id)
            ->whereIn('id', $selectedIds)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Tidak ditemukan produk yang dipilih.');
        }

        return view('frontend.cart.checkout', compact('cartItems'));
    }
}
