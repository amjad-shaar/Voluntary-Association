@extends('layouts.front.body')

@section('css')
  <style>
     
    .hero {
      background: url('{{asset('storage/app/public/main-image.jpg')}}') no-repeat center center/cover;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      text-align: center;
      position: relative;
    }
    .hero::before {
      content: "";
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0,0,0,0.6);
    }
    .hero-content {
      position: relative;
      z-index: 1;
    }
    .section-title {
      font-size: 2rem;
      font-weight: bold;
      margin-bottom: 30px;
      text-align: center;
      color: #333;
    }
    .card:hover {
      transform: translateY(-5px);
      transition: 0.3s;
    }
    footer {
      background: #212529;
      color: #ddd;
      padding: 20px 0;
      text-align: center;
    }
  </style>
 @endsection

@section('content')

<!-- Hero -->
  <section class="hero">
    <div class="hero-content">
      <h1 class="display-4 fw-bold">شارك في بناء مجتمع أفضل</h1>
      <p class="lead">انضم إلى حملاتنا التطوعية وكن جزءاً من التغيير</p>
      <a href="#" class="btn btn-primary btn-lg mt-3">استعرض الحملات</a>
    </div>
  </section>

  <!-- About -->
  <section class="py-5">
    <div class="container">
      <h2 class="section-title">من نحن</h2>
      <p class="text-center text-muted mx-auto fs-5" style="max-width:700px;">
        نحن مؤسسة مجتمعية تهدف إلى تعزيز العمل التطوعي في مجالات التعليم، البيئة، وتوزيع المساعدات. 
        نسعى لتمكين الشباب والمتطوعين من تقديم أفضل ما لديهم لخدمة مجتمعهم.
      </p>
    </div>
  </section>

  <!-- Campaigns -->
  <section class="py-5 bg-light">
    <div class="container">
      <h2 class="section-title">أحدث الحملات</h2>
      <div class="row g-4">
        @if($campaigns->count() > 0)
        @foreach($campaigns as $campaign)
        <div class="col-10 col-md-6 col-lg-4">
          <div class="card shadow-sm">
            <img src="{{$campaign->image}}" class="card-img-top" alt="توزيع مساعدات">
            <div class="card-body">
              <h5 class="card-title">{{$campaign->title}}</h5>
              <p class="card-text text-muted">{{$campaign->description}}</p>
              <a href="{{route('campaign',$campaign->id)}}" class="btn btn-outline-primary btn-sm">انضم الآن</a>
            </div>
          </div>
        </div>
        @endforeach
        @else
        <p class="fs-3 fw-bolder">لا يوجد حملات بعد</p>
        @endif
        
      </div>
    </div>
  </section>

@endsection

@section('script')
<script>
      

    
</script>
 @endsection

 