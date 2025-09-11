<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use App\Models\MembershipPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class MemberRegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        $membershipOptions = [
            [
                'id' => 'basic',
                'name' => 'Basic Member',
                'price' => 100000,
                'duration' => '1 Year',
                'features' => [
                    'Access to basic content',
                    'Limited uploads',
                    'Basic support'
                ]
            ],
            [
                'id' => 'premium',
                'name' => 'Premium Member',
                'price' => 250000,
                'duration' => '1 Year',
                'features' => [
                    'Full content access',
                    'Unlimited uploads',
                    'Priority support',
                    'Exclusive events'
                ]
            ],
            [
                'id' => 'pro',
                'name' => 'Professional Member',
                'price' => 500000,
                'duration' => '1 Year',
                'features' => [
                    'All premium features',
                    'Featured profile',
                    'Professional tools',
                    'Direct mentoring'
                ]
            ]
        ];

        return view('member.register', compact('membershipOptions'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults(), 'min:8'],
            'membership_type' => ['required', 'in:basic,premium,pro'],
            'kota_id' => ['required', 'exists:kabupaten_kotas,id'],
            'agree_terms' => ['required', 'accepted']
        ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'MEMBER', // Atau role khusus untuk member
            'subdep_kode' => '000',
        ]);

        // Create member record
        $memberId = 'MEM-' . Str::upper(Str::random(8));
        $member = Member::create([
            'id_member' => $memberId,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'status' => 'pending_payment',
            'kota_id' => $request->kota_id,
            'tanggal_bergabung' => now(),
        ]);

        // Determine payment amount based on membership type
        $amount = 0;
        switch ($request->membership_type) {
            case 'basic':
                $amount = 100000;
                break;
            case 'premium':
                $amount = 250000;
                break;
            case 'pro':
                $amount = 500000;
                break;
        }

        // Create payment record
        $payment = MembershipPayment::create([
            'user_id' => $user->id,
            'member_id' => $memberId,
            'amount' => $amount,
            'payment_method' => 'pending',
            'status' => 'pending',
            'transaction_id' => 'PAY-' . Str::upper(Str::random(10)),
            'expires_at' => now()->addDays(3)
        ]);

        event(new Registered($user));

        // Redirect to payment page
        return redirect()->route('member.payment', $payment->id);
    }

    public function showPaymentForm($paymentId)
    {
        $payment = MembershipPayment::findOrFail($paymentId);
        return view('member.payment', compact('payment'));
    }

    public function processPayment(Request $request, $paymentId)
    {
        // Implement payment processing logic here
        // This would depend on your payment gateway
    }
}
