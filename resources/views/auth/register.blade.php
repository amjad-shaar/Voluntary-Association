@extends('layouts.shared.body')
@section('main_page_head')
<style>
    .register-bg {
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
     
</style>
@endsection

@section('main_page_body')
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-lg overflow-hidden">
                <div class="row g-0">
                    <!-- صورة الجانب -->
                    <div class="col-md-6 d-none d-md-block register-bg">
                        <div class="h-100 d-flex flex-column justify-content-center text-center text-white p-5">
                            <h2 class="mb-4">مرحبًا بك!</h2>
                            <p class="lead">أنشئ حسابك الجديد للبدء</p>
                            <div class="mt-4">
                                <i class="bi bi-person-plus display-4"></i>
                            </div>
                        </div>
                    </div>

                    <!-- نموذج التسجيل -->
                    <div class="col-md-6">
                        <div class="card-body p-5">
                            <h3 class="card-title text-center mb-4">إنشاء حساب جديد</h3>
                            
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <!-- الاسم الكامل -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">الاسم الكامل</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        <input id="name" type="text" class="form-control" name="name" 
                                               value="{{ old('name') }}" required autofocus
                                               placeholder="أدخل اسمك الكامل">
                                    </div>
                                    @error('name')
                                        <span class="mt-2 text-danger small">{{$errors->get('name')}}</span>
                                    @enderror
                                </div>

                                <!-- البريد الإلكتروني -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">البريد الإلكتروني</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input id="email" type="email" class="form-control" name="email" 
                                               value="{{ old('email') }}" required
                                               placeholder="أدخل بريدك الإلكتروني">
                                    </div>
                                    @error('email')
                                        <span class="mt-2 text-danger small">{{$errors->get('email')}}</span>
                                    @enderror
                                </div>

                                <!-- كلمة المرور -->
                                <div class="mb-3">
                                    <label for="password" class="form-label">كلمة المرور</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                        <input id="password" type="password" class="form-control" 
                                               name="password" required autocomplete="new-password"
                                               placeholder="أدخل كلمة المرور">
                                        <button class="btn btn-info btn-outline-secondary toggle-password" type="button">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <span class="mt-2 text-danger small">{{$errors->get('password')}}</span>
                                    @enderror
                                </div>

                                <!-- تأكيد كلمة المرور -->
                                <div class="mb-4">
                                    <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                        <input id="password_confirmation" type="password" class="form-control" 
                                               name="password_confirmation" required
                                               placeholder="أعد إدخال كلمة المرور">
                                        <button class="btn btn-info btn-outline-secondary toggle-password-confirm" type="button">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    @error('password_confirmation')
                                        <span class="mt-2 text-danger small">{{$errors->get('password_confirmation')}}</span>
                                    @enderror
                                </div>

                                <!-- زر التسجيل -->
                                <button type="submit" class="btn btn-primary w-100 py-2 mb-3">
                                    <i class="bi bi-person-plus me-2"></i> إنشاء حساب
                                </button>

                                <!-- رابط تسجيل الدخول -->
                                <div class="text-center mt-4">
                                    <p class="mb-0">لديك حساب بالفعل؟ 
                                        <a href="{{ route('login') }}" class="text-decoration-none">
                                            سجل دخولك الآن
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
        // تبديل رؤية كلمة المرور
        const togglePassword = document.querySelector('.toggle-password');
        const password = document.querySelector('#password');
        
        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.querySelector('i').classList.toggle('bi-eye');
            this.querySelector('i').classList.toggle('bi-eye-slash');
        });

        // تبديل رؤية تأكيد كلمة المرور
        const togglePasswordConfirm = document.querySelector('.toggle-password-confirm');
        const passwordConfirm = document.querySelector('#password_confirmation');
        
        togglePasswordConfirm.addEventListener('click', function() {
            const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirm.setAttribute('type', type);
            this.querySelector('i').classList.toggle('bi-eye');
            this.querySelector('i').classList.toggle('bi-eye-slash');
        });
    });
</script>
@endsection