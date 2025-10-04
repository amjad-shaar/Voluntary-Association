@extends('layouts.front.body')

@section('css')
  <style>
  
  </style>
 @endsection

@section('content')


<div class="container py-4">
  <h2 class="mb-4 text-center">📌 جميع الحملات</h2>

  <div class="row g-4">

  @if($campaigns->count() > 0)
  @foreach($campaigns as $campaign)
   <!-- كارد حملة -->
    <div class="col-md-4">
      <div class="card shadow-lg border-0 h-100">
        <img src="{{$campaign->image}}" 
             class="card-img-top" 
             alt="{{$campaign->title}}" 
             style="height:200px; object-fit:cover;">

        <div class="card-body d-flex flex-column">
          <h5 class="card-title">{{$campaign->title}}</h5>

          <p class="card-text text-muted mb-1">
            📍 <strong>الموقع:</strong> {{$campaign->location}}
          </p>

          <p class="card-text text-muted mb-1">
            📅 <strong>الفترة:</strong> {{ $campaign->start_date->format('d-m-Y') }} → {{ $campaign->end_date->format('d-m-Y') }}
          </p>

          <p class="card-text text-muted mb-1">
            👤 <strong>المنظم:</strong> {{ $campaign->organizer?->name ?? 'غير محدد' }}
          </p>
          
          <div class="mt-auto">
            <a href="{{route('campaign',$campaign->id)}}" class="btn btn-primary w-100">📖 تفاصيل الحملة</a>
          </div>
        </div>
      </div>
    </div>
    <!-- نهاية الكارد -->
  @endforeach
  @else
  <p class="fs-4">لا يوجد حملات بعد</p>
  @endif
   
 
  </div>
</div>


@endsection

@section('script')
<script>
      

    
</script>
 @endsection

 