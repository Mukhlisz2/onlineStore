<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
{
    if (!Auth::check()) {
        dd('User not authenticated');
    }

    $userRole = Auth::user()->getRole();  // Pastikan ini mengembalikan nilai role atau is_admin

    if ($userRole === 'admin') {
        return $next($request);
    }

    dd('User is authenticated but role is not admin: ' . $userRole);
}
}
