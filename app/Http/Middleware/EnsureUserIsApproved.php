<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Mirrors the old admin_profile.php "is_approved" gate: an account that was
 * rejected (-1) or is still pending (0) cannot use the marketplace yet.
 */
class EnsureUserIsApproved
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && !$user->isAdmin() && !$user->isApproved()) {
            auth()->logout();
            $request->session()->invalidate();

            return redirect()->route('login')
                ->withErrors(['username' => 'Your account is still pending admin approval.']);
        }

        return $next($request);
    }
}
