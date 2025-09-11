<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // app/Http/Controllers/PaymentController.php

    public function index()
    {
        $payments = Transaction::with('user')->get();
        $user = auth()->user();
        return view('admin.payment.index', compact('payments', 'user'));
    }
    public function updateStatus(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        // Validasi bahwa status saat ini adalah 'proses'
        if ($transaction->status !== 'proses') {
            return back()->with('error', 'Hanya transaksi dengan status "proses" yang bisa diubah ke "done"');
        }

        $transaction->update(['status' => 'done']);

        return back()->with('success', 'Status berhasil diubah menjadi done');
    }
    public function create()
    {
        return view('admin.payments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'description' => 'required',
            'image' => 'nullable|image',
            'price' => 'required|numeric',
            'payment_proof' => 'nullable|image',
        ]);

        $imagePath = $request->file('image')?->store('products', 'public');
        $proofPath = $request->file('payment_proof')?->store('proofs', 'public');

        Payment::create([
            'user_id' => auth()->id(),
            'product_name' => $request->product_name,
            'description' => $request->description,
            'image' => $imagePath,
            'price' => $request->price,
            'payment_proof' => $proofPath,
            'status' => 'pending',
        ]);

        return redirect()->route('payments.index')->with('success', 'Payment submitted');
    }
}
