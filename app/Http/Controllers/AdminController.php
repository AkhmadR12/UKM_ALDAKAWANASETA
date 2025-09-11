<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dasboard'); // resources/views/admin/dashboard.blade.php
    }
    public function admin()
    {
        return view('admin.home'); // resources/views/admin/dashboard.blade.php
    }
    // public function coba()
    // {
    //     $user = auth()->user();
    //     $isAdminOrStaff = in_array($user->role, ['admin', 'karyawan', 'member']);
    //     $isMember = $user->role === 'member';

    //     if ($isAdminOrStaff) {
    //         // ADMIN / KARYAWAN LIHAT SEMUA DATA
    //         $totalRevenueDone = Transaction::where('status', 'done')->sum('amount');
    //         $totalRevenuePending = Transaction::where('status', 'proses')->sum('amount');
    //         $totalProductsSold = Transaction::sum('qty');
    //         $totalMyProducts = Product::count(); // semua produk

    //         // Hitung pendapatan admin (30% dari total done)
    //         $adminRevenue = $totalRevenueDone * 0.3;
    //         // Hitung pendapatan member (70% dari total done)
    //         $memberRevenue = $totalRevenueDone * 0.7;
    //     } else {
    //         // MEMBER LIHAT BERDASARKAN PRODUK MILIK SENDIRI
    //         $productIds = Product::where('user_id', $user->id)->pluck('id');

    //         $transactions = Transaction::whereHas('orderItems.product', function ($q) use ($user) {
    //             $q->where('user_id', $user->id);
    //         })->with('orderItems.product')->get();

    //         $totalRevenueDone = 0;
    //         $totalRevenuePending = 0;
    //         $totalProductsSold = 0;

    //         foreach ($transactions as $transaction) {
    //             foreach ($transaction->orderItems as $item) {
    //                 if ($item->product->user_id == $user->id) {
    //                     $total = $item->price * $item->qty;
    //                     $totalProductsSold += $item->qty;

    //                     if ($transaction->status == 'done') {
    //                         $totalRevenueDone += $total;
    //                     } elseif ($transaction->status == 'proses') {
    //                         $totalRevenuePending += $total;
    //                     }
    //                 }
    //             }
    //         }

    //         $totalMyProducts = $productIds->count();
    //         $memberRevenue = $totalRevenueDone; // Member dapat 100% dari pendapatan done mereka
    //         $adminRevenue = 0; // Tidak ditampilkan untuk member
    //     }

    //     return view('admin.coba', compact(
    //         'totalRevenueDone',
    //         'totalRevenuePending',
    //         'totalProductsSold',
    //         'totalMyProducts',
    //         'isAdminOrStaff',
    //         'adminRevenue',
    //         'memberRevenue'
    //     ));
    // }
    public function coba()
    {
        $user = auth()->user();
        $isAdminOrStaff = in_array($user->role, ['admin', 'karyawan']);
        $isMember = $user->role === 'member';
        $member = Member::all();
        if ($isAdminOrStaff) {
            // ADMIN / KARYAWAN LIHAT SEMUA DATA
            $totalAmountDone = Transaction::where('status', 'done')->sum('amount');
            $totalRevenueDone = $totalAmountDone * 0.7; // Member 70%
            $adminRevenue = $totalAmountDone * 0.3; // Admin 30%
            $totalRevenuePending = Transaction::where('status', 'proses')->sum('amount');
            $totalProductsSold = Transaction::sum('qty');
            $totalMyProducts = Product::count();
            $totalMembers = Member::count();
            // Data untuk tabel withdraw (hanya admin)
            $usersWithIncome = [];
            if ($user->role === 'admin') {
                $usersWithIncome = User::with(['transactions' => function ($query) {
                    $query->where('status', 'done');
                }])->get()->map(function ($user) {
                    $doneTransactions = $user->transactions->where('status', 'done');
                    $totalAmount = $doneTransactions->sum('amount');

                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                        'role' => $user->role,
                        'member_income' => $totalAmount * 0.7,
                        'admin_income' => $totalAmount * 0.3,
                        'withdrawn_amount' => $user->withdrawn_amount
                    ];
                });
            }
            // } elseif ($isMember) {
            //     // MEMBER LIHAT BERDASARKAN PRODUK MILIK SENDIRI
            //     $productIds = Product::where('user_id', $user->id)->pluck('id');

            //     $transactions = Transaction::whereHas('orderItems.product', function ($q) use ($user) {
            //         $q->where('user_id', $user->id);
            //     })->with('orderItems.product')->get();

            //     $totalRevenueDone = 0;
            //     $totalRevenuePending = 0;
            //     $totalProductsSold = 0;

            //     foreach ($transactions as $transaction) {
            //         foreach ($transaction->orderItems as $item) {
            //             if ($item->product->user_id == $user->id) {
            //                 $total = $item->price * $item->qty;
            //                 $totalProductsSold += $item->qty;

            //                 if ($transaction->status == 'done') {
            //                     $totalRevenueDone += $total;
            //                 } elseif ($transaction->status == 'proses') {
            //                     $totalRevenuePending += $total;
            //                 }
            //             }
            //         }
            //     }

            //     $totalMyProducts = $productIds->count();
            //     $adminRevenue = 0;
            //     $usersWithIncome = [];
            // }
        } elseif ($isMember) {
            // MEMBER LIHAT BERDASARKAN PRODUK MILIK SENDIRI
            $productIds = Product::where('user_id', $user->id)->pluck('id');

            // Menggunakan relasi product yang sudah ada
            $transactions = Transaction::whereHas('product', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })->with('product')->get();

            $totalRevenueDone = 0;
            $totalRevenuePending = 0;
            $totalProductsSold = 0;
            $totalMembers = 0;
            foreach ($transactions as $transaction) {
                // Langsung menggunakan product dari transaction
                if ($transaction->product && $transaction->product->user_id == $user->id) {
                    $total = $transaction->amount;
                    $totalProductsSold += $transaction->qty;

                    if ($transaction->status == 'done') {
                        $totalRevenueDone += $total;
                    } elseif ($transaction->status == 'proses') {
                        $totalRevenuePending += $total;
                    }
                }
            }

            $totalMyProducts = $productIds->count();
            $adminRevenue = 0;
            $usersWithIncome = [];
        }

        return view('admin.coba', compact(
            'totalRevenueDone',
            'totalRevenuePending',
            'totalProductsSold',
            'totalMyProducts',
            'isAdminOrStaff',
            'adminRevenue',
            'user',
            'usersWithIncome',
            'member',
            'totalMembers'
        ));
    }

    public function processWithdraw(Request $request, $userId)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $user = User::findOrFail($userId);

        $doneTransactions = Transaction::where('user_id', $userId)
            ->where('status', 'done')
            ->get();

        $totalAmount = $doneTransactions->sum('amount');
        $memberIncome = $totalAmount * 0.7;

        // Update withdrawn amount
        $user->withdrawn_amount += $memberIncome;
        $user->save();

        // Mark transactions as withdrawn (optional)
        Transaction::where('user_id', $userId)
            ->where('status', 'done')
            ->update(['status' => 'withdrawn']);

        return redirect()->route('admin.coba')->with('success', 'Withdraw berhasil dilakukan');
    }
}
