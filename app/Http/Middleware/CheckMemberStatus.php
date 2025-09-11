<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckMemberStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'MEMBER') {
            $member = Auth::user()->member;

            if ($member && $member->status === 'pending_payment') {
                return redirect()->route('member.payment', $member->payments()->latest()->first()->id)
                    ->with('error', 'Please complete your membership payment.');
            }

            if ($member && $member->status === 'inactive') {
                return redirect()->route('member.renew')
                    ->with('error', 'Your membership has expired. Please renew.');
            }
        }

        return $next($request);
    }
}
