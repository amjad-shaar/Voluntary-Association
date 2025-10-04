<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string|null $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return match ($guard) {
                'admin' => redirect('/admin'),
                default => redirect('/profile'),
            };
        }

        return $next($request);
    }
}