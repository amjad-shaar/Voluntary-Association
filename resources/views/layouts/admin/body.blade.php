@extends('layouts.shared.body')

@section('main_page_head')
  <!-- head -->
  @include('layouts.admin.head')
  @yield('css')
  <!-- head -->
    
  <style>
    
  </style>
@endsection


@section('main_page_body')

<!-- Sidebar -->
@include('admin.includes.sidebar')
<!-- Sidebar -->

<!-- Navbar -->
@include('admin.includes.navbar')
<!-- Navbar -->

  <!-- content -->
  @yield('content')
  <!-- content -->

 
  <!-- footer -->
  @include('admin.includes.footer')
  <!-- footer -->
  
 
@endsection


@section('main_page_script')

  @include('layouts.admin.js')
  @yield('script')

@endsection
