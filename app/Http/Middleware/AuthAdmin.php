<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan user ter-auth dan role-nya 'admin'
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        return response()->json(['message' => 'Unauthorized. Admin only.'], 403);
    }
}
