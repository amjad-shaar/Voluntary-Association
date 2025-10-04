<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class CustomSessionGuard
{
    public function handle($request, Closure $next)
    {
        // تحديد الحارس الحالي من الـ route
        $currentGuard = $this->detectGuard($request);

        // إذا وجدنا الحارس نغير الـ session cookie
        if ($currentGuard && isset(config('auth.guards')[$currentGuard]['session_cookie'])) {
            Config::set('session.cookie', config('auth.guards')[$currentGuard]['session_cookie']);
       /* $cookieName = config('auth.guards')[$currentGuard]['session_cookie'];
            dd($currentGuard, $cookieName);*/
        }

       /* dd([
    'path' => $request->path(),
    'detected_guard' => $currentGuard,
    'cookies' => $request->cookies->all(),
]);*/
        return $next($request);
    }

    /**
     * اكتشاف الحارس بناءً على الرابط أو الجلسة
     */
    protected function detectGuard($request)
    {
        $path = $request->path(); // يعطي: store-dashboard أو store-dashboard/login


        // أي رابط يبدأ بـ admin
        if (Str::startsWith($path, 'admin')) {
            return 'admin';
        }

        // غير ذلك
        return 'web';
    }
}
