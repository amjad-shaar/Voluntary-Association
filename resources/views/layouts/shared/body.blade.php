
<!DOCTYPE html>
<html lang="ar" dir="rtl">

  <head>
    @include('layouts.shared.head')
    @yield('main_page_head')
  </head>
  
  <body class="placeholder-glow">
   
    <div data-sos-once="true" data-sos="sos-top" class="progress-scroll-bage-x-line">
      <div class="progress-scroll-bage-x bg-gradient-danger overflow-hidden">
        <div class=" glossy"></div>
      </div>
    </div>

    <button data-sos-once="true" data-sos="sos-left" class="h-auto btn btn-dark scroll-button-top scroll-button-to-hidden p-2 rounded-5 mx-auto" aria-label="go to top"><i class="bi bi-arrow-up fs-5 text-white"></i></button>
 
    <main class="">
        @yield('main_page_body')

        
        @include('layouts.shared.includes.alerts.notification')
    </main>

    @include('layouts.shared.js')
    @yield('main_page_script')

  </body>
</html>


