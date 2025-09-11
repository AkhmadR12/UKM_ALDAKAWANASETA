<?php

namespace App\Listeners;

use App\Events\PaymentCompleted;
use App\Models\Member;
use App\Notifications\MembershipActivated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ActivateMember
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PaymentCompleted $event)
    {
        $payment = $event->payment;

        // Update member status
        $member = Member::find($payment->member_id);
        if ($member) {
            $member->status = 'active';
            $member->save();
        }

        // Update user role if needed
        $user = $payment->user;
        if ($user && $user->role !== 'MEMBER') {
            $user->role = 'MEMBER';
            $user->save();
        }

        // Send notification email
        $user->notify(new MembershipActivated($payment));
    }
}
