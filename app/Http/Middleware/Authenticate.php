<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return $next($request);
            }
        }

        // تحديد صفحة تسجيل الدخول بناءً على الحارس (guard)
        $redirectRoute = $this->getLoginRouteForGuard($guards[0] ?? null);
        
        throw new AuthenticationException(
            'Unauthenticated.', 
            $guards, 
            $redirectRoute
        );
    }

    /**
     * تحديد صفحة تسجيل الدخول المناسبة بناءً على الحارس.
     */
    protected function getLoginRouteForGuard(?string $guard): string
    {
        return match ($guard) {
            'admin'    => route('admin.login'),   // توجيه إلى تسجيل دخول الأدمن
            default    => route('login'),        // توجيه إلى تسجيل دخول المستخدم العادي
        };
    }
}