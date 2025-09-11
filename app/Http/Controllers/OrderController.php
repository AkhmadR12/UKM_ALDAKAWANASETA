<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // public function store(Request $request)
    // {
    //     $user = Auth::user();

    //     $request->validate([
    //         'cart_ids' => 'required|array'
    //     ]);

    //     $cartIds = $request->input('cart_ids');

    //     $cartItems = Cart::with('product')
    //         ->where('user_id', $user->id)
    //         ->whereIn('id', $cartIds)
    //         ->get();

    //     if ($cartItems->isEmpty()) {
    //         return redirect()->route('cart.index')->with('error', 'Cart kosong atau tidak valid.');
    //     }

    //     // Lanjut ke halaman upload bukti
    //     return view('frontend.cart.checkout-multi', compact('cartItems'));
    // }
    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'cart_ids' => 'required|array'
        ]);

        $cartIds = $request->input('cart_ids');

        $cartItems = Cart::with('product')
            ->where('user_id', $user->id)
            ->whereIn('id', $cartIds)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Cart kosong atau tidak valid.');
        }

        $transactions = [];

        foreach ($cartItems as $item) {
            $transactions[] = Transaction::create([
                'user_id' => $user->id,
                'product_id' => $item->product->id,
                'qty' => $item->quantity,
                'amount' => $item->product->price * $item->quantity,
                'status' => 'pending',
                'type' => 'checkout',
                'transaction_code' => 'TRX-' . strtoupper(uniqid()),
            ]);
        }

        // Ambil ID transaction untuk dikirim ke form upload bukti
        $transactionIds = collect($transactions)->pluck('id')->toArray();

        return view('frontend.cart.checkout-multi', compact('transactions', 'transactionIds'));
    }

    public function index()
    {
        $orders = Auth::user()->orders()->with('items.product')->latest()->get();
        return view('frontend.cart.index', compact('orders'));
    }
    
}
