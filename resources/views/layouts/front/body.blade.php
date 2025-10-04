@extends('layouts.shared.body')

@section('main_page_head')
  <!-- head -->
  @include('layouts.front.head')
  @yield('css')
  <!-- head -->
    
  <style>
    
  </style>
@endsection


@section('main_page_body')

  <!-- Navbar -->
  @include('front.includes.navbar')
  <!-- Navbar -->

  <!-- content -->
  
  @yield('content')
  <!-- content -->

  
  @guest
    @include('front.includes.login-modal')
  @endguest
  <!-- alerts -->

  <!-- footer -->
  @include('front.includes.footer')
  <!-- footer -->
  
@endsection


@section('main_page_script')

  @include('layouts.front.js')
  @yield('script')

@endsection
