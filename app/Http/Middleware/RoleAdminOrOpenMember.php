<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Member;

class RoleAdminOrOpenMember
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
    // public function handle(Request $request, Closure $next)
    // {
    //     $user = Auth::user();

    //     if (!$user) {
    //         abort(403, 'Unauthorized');
    //     }

    //     // ✅ Izinkan admin
    //     if ($user->role === 'admin') {
    //         return $next($request);
    //     }

    //     // ✅ Izinkan member hanya jika status di model Member = OPEN
    //     // if ($user->role === 'member') {
    //     //     $member = Member::where('user_id', $user->id)->first();

    //     //     if ($member && $member->status === 'OPEN') {
    //     //         return $next($request);
    //     //     }
    //     // }
    //     if ($user->role === 'member') {
    //         $member = Member::where('user_id', $user->id)->first();

    //         if (
    //             $member &&
    //             $member->status === 'OPEN' &&
    //             now()->lessThanOrEqualTo($member->tanggal_berakhir)
    //         ) {
    //             return $next($request);
    //         }
    //     }


    //     // ❌ Selain itu dilarang
    //     abort(403, 'Access denied');
    // }
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Unauthorized');
        }

        // ✅ Izinkan admin dan member
        if ($user->role === 'admin' || $user->role === 'member') {
            return $next($request);
        }

        // ❌ Selain itu dilarang
        abort(403, 'Access denied');
    }
}
