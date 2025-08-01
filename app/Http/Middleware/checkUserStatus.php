<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class checkUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && !User::withTrashed()->find(Auth::id())) {
            session()->flash('error', 'Akun Anda telah dinonaktifkan.');
            Auth::logout();
            return redirect()->route('login');
        }

        return $next($request);
    }
}
