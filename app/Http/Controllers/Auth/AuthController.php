<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Support\Carbon;

class AuthController extends Controller
{
    /**
     * عرض نموذج تسجيل الدخول للمستخدم العادي
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * عرض نموذج التسجيل للمستخدم العادي
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    
    /**
     * معالجة طلب تسجيل الدخول
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $user_role = auth()->user()->role;
 
            if($user_role == 'admin' || $user_role == 'organizer'){
                return redirect()->intended(route('dashboard'));

            }else{
                return redirect()->intended(route('profile')); 
            }
        }

        return back()->withErrors([
            'email' => 'بيانات الاعتماد هذه غير متطابقة مع سجلاتنا.',
        ])->withInput($request->only('email', 'remember'));
    }

    /**
     * معالجة طلب التسجيل
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(10),
        ]);

        event(new Registered($user));

        Auth::login($user);
        
        return redirect()->route('profile');
    }

    /**
     * تسجيل الخروج
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
  
    
}



/*
php artisan tinker
$admin = new App\Models\Admin();
$admin -> name ="amjad";
$admin -> email ="admin@admin.com";
$admin -> password =bcrypt("123123123");
$admin ->save();
*/