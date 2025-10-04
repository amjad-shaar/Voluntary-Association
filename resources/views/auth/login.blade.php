@extends('layouts.shared.body')
@section('main_page_head')
<style>
        .login-bg {
            background-repeat: round!important;
            background: url({{asset('public/assets/img/15.jpg')}});
        }
        .card {
            border: none;
            border-radius: 15px;
        }
        .form-control {
            padding: 10px 15px;
            border-radius: 8px;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(59, 130, 246, 0.25);
        }
        .btn-primary {
            background-color: #3b82f6;
            border: none;
            border-radius: 8px;
            padding: 10px;
            font-weight: 500;
        }
        .toggle-password {
            border-top-right-radius: 8px !important;
            border-bottom-right-radius: 8px !important;
            
        }
    </style>

@endsection

@section('main_page_body')
      
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-10 col-lg-8">
                <div class="card shadow-lg overflow-hidden">
                    <div class="row g-0">
                        <!-- صورة الجانب -->
                        <div class="col-md-6 d-none d-md-block login-bg">
                            <div class="h-100 d-flex flex-column justify-content-center text-center text-white p-5">
                                <h2 class="mb-4">مرحبًا بعودتك!</h2>
                                <p class="lead">سجل دخولك للوصول إلى حسابك</p>
                                <div class="mt-4">
                                    <i class="bi bi-person-circle display-4"></i>
                                </div>
                            </div>
                        </div>

                        <!-- نموذج تسجيل الدخول -->
                        <div class="col-md-6">
                            <div class="card-body p-5">
                                <h3 class="card-title text-center mb-4">تسجيل الدخول</h3>
                                
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <!-- البريد الإلكتروني -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label">البريد الإلكتروني</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                            <input id="email" type="email" class="form-control" name="email" 
                                                   value="{{ old('email') }}" required autofocus
                                                   placeholder="أدخل بريدك الإلكتروني">
                                        </div>
                                        @error('email')
                                        <span class="mt-2 text-danger small">{{$errors->get('email')}}</span>
                                        @enderror
                                    </div>

                                    <!-- كلمة المرور مع زر العين -->
                                    <div class="mb-3">
                                        <label for="password" class="form-label">كلمة المرور</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                            <input id="password" type="password" class="form-control" 
                                                   name="password" required autocomplete="current-password"
                                                   placeholder="أدخل كلمة المرور">
                                            <button class="btn btn-info btn-outline-secondary toggle-password" type="button">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                        @error('password')
                                        <span class="mt-2 text-danger small">{{$errors->get('password')}}</span>
                                        @enderror
                                    </div>

                                    <!-- تذكرني ونسيت كلمة المرور -->
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                                            <label class="form-check-label" for="remember_me">تذكرني</label>
                                        </div>
                                        
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" class="text-decoration-none small">
                                                نسيت كلمة المرور؟
                                            </a>
                                        @endif
                                    </div>

                                    <!-- زر تسجيل الدخول -->
                                    <button type="submit" class="btn btn-primary w-100 py-2 mb-3">
                                        <i class="bi bi-box-arrow-in-right me-2"></i> تسجيل الدخول
                                    </button>
                                    

                                    <!-- رابط التسجيل -->
                                    <div class="text-center mt-4">
                                        <p class="mb-0">ليس لديك حساب؟ 
                                            <a href="{{ route('register') }}" class="text-decoration-none">
                                                سجل الآن
                                            </a>
                                        </p>
                                    </div>
                                </form>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

@endsection
@section('main_page_script')
   
   <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.querySelector('.toggle-password');
            const password = document.querySelector('#password');
            
            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                
                // تغيير الأيقونة
                this.querySelector('i').classList.toggle('bi-eye');
                this.querySelector('i').classList.toggle('bi-eye-slash');
            });
        });
    </script>
@endsection
 