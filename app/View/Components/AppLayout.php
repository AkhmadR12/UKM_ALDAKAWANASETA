<?php

namespace App\View\Components;

use App\Models\FormInput;
use App\Models\Transaction;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    // public function render(): View
    // {
    //     return view('layouts.app');
    // }

    // public function render(): View
    // {
    //     // Ambil data transaksi dengan status 'proses' atau 'pending'
    //     $notifications = Transaction::whereIn('status', ['proses', 'pending'])
    //         ->latest()
    //         ->take(10) // tampilkan hanya 10 notifikasi terakhir
    //         ->get();

    //     return view('layouts.app', [
    //         'notifications' => $notifications,
    //         'notificationCount' => $notifications->count(),
    //     ]);
    // }
    public function render(): View
    {
        // Get FormInput records with status INPG or CLSD from the last 2 days
        $notifications = FormInput::whereIn('status', ['INPG', 'CLSD'])
            ->where('created_at', '>=', now()->subDays(2))
            ->latest()
            ->take(10) // show only 10 latest notifications
            ->get();

        return view('layouts.app', [
            'notifications' => $notifications,
            'notificationCount' => $notifications->count(),
        ]);
    }
}
