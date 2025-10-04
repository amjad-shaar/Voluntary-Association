
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container-fluid">
      <span class="navbar-brand ms-auto">مرحباً، <strong>{{auth()->user()->name}}</strong></span>
      <div class="d-flex align-items-center">
        <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" 
             alt="Admin Avatar" width="40" height="40" class="rounded-circle me-2">
         <a href="#" class="nav-link fw-bold px-0" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="bi bi-box-arrow-left fs-5"></i>
          <span class="">الخروج </span>
        </a> 
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
      </div>
    </div>
  </nav>