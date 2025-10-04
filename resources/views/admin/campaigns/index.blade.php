@extends('layouts.admin.body')

@section('css')
 
 @endsection

@section('content')
 <div class="content pt-5 mt-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h3>📌 إدارة الحملات</h3>
      <a href="{{ route('campaigns.create') }}" class="btn btn-primary">➕ إضافة حملة جديدة</a>
    </div>
@if(!empty($campaigns) && $campaigns->count())
    <!-- Campaigns Table -->
    <div class="card shadow-sm">
      <div class="card-header bg-light fw-bold">قائمة الحملات</div>
      <div class="card-body table-responsive">
        <table class="table table-striped align-middle">
          <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>العنوان</th>
              <th>الوصف</th>
              <th>الموقع</th>
              <th>الفترة</th>
              <th>منشئ الحملة</th>
              <th>المنظم</th>
              <th>عدد المهام</th>
              <th>الإجراءات</th>
            </tr>
          </thead>
          <tbody>
            @foreach($campaigns as $campaign)
            <tr>
              <td>#{{$campaign->id}}</td>
              <td>{{$campaign->title}}</td>
              <td>{{ \Illuminate\Support\Str::limit($campaign->description, 25) }}</td>
              <td>{{$campaign->location}}</td>
              <td>{{$campaign->start_date->format('d-m-Y')}} → {{$campaign->end_date->format('d-m-Y')}}</td>
              <td>{{$campaign->owner->name}}</td>
              <td>{{$campaign->organizer->name}}</td>
              <td><span class="badge bg-primary">{{$campaign->tasks->count()}}</span></td>
              <td>
                <a href="{{route('campaign',$campaign->id)}}" class="btn btn-sm btn-info text-white mt-1">👁 عرض</a>
                <a href="{{ route('campaigns.edit', $campaign->id) }}" class="btn btn-sm bg-gradient-warning mt-1">✏️ تعديل</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    @else
     <div class="fs-4 text-center p-5 fw-bolder">لا يوجد حملات بعد</div>
@endif
    

  </div>
@endsection

@section('script')
<script>
      

    
</script>
 @endsection

 