<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-dark shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">💙 التطوع للمجتمع</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link active" href="{{route('home')}}">الرئيسية</a></li>
          <li class="nav-item"><a class="nav-link" href="{{route('campaigns')}}">الحملات</a></li>
          @auth
          <li class="nav-item"><a class="nav-link" href="{{route('profile')}}">الملف الشخصي</a></li>
          @if(auth()->user()->role == 'admin' || auth()->user()->role == 'organizer')
          <li class="nav-item"><a class="nav-link" href="{{route('dashboard')}}">لوحة التحكم</a></li>
            @endif
          @else
          <li class="nav-item"><a class="nav-link" href="{{route('login')}}">تسجيل الدخول</a></li>
          <li class="nav-item"><a class="nav-link btn btn-outline-light ms-2" href="{{route('register')}}">إنشاء حساب</a></li>
          @endauth
        </ul>
      </div>
    </div>
</nav>