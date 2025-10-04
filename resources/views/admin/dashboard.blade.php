@extends('layouts.admin.body')

@section('css')
 
 @endsection

@section('content')
<!-- Content -->
<div class="content pt-5 mt-4">

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
      <div class="col-md-3">
        <div class="card text-center shadow-sm p-3">
          <h5>👥 المستخدمون</h5>
          <h2 class="text-primary">{{$usersCount}}</h2>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card text-center shadow-sm p-3">
          <h5>📌 الحملات</h5>
          <h2 class="text-success">{{$campaignsCount}}</h2>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card text-center shadow-sm p-3">
          <h5>📝 المهام</h5>
          <h2 class="text-warning">{{$tasksCount}}</h2>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card text-center shadow-sm p-3">
          <h5>📑 التقارير</h5>
          <h2 class="text-danger">{{$reportsCount}}</h2>
        </div>
      </div>
    </div>

    <!-- Latest Users -->
    @if($latestUsers->count() > 0)
      <div class="card shadow-sm mb-4">
        <div class="card-header bg-light fw-bold">👥 آخر المستخدمين المسجلين</div>
        <div class="card-body table-responsive">
          <table class="table table-striped align-middle">
            <thead>
              <tr>
                <th>الاسم</th>
                <th>البريد</th>
                <th>تاريخ التسجيل</th>
              </tr>
            </thead>
            <tbody>
              @foreach($latestUsers as $user)
              <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    @endif
    @if($latestUsers->count() > 0)
    <!-- Latest Campaigns -->
    <div class="card shadow-sm">
      <div class="card-header bg-light fw-bold">📌 أحدث الحملات</div>
      <div class="card-body table-responsive">
        <table class="table table-striped align-middle">
          <thead>
            <tr>
              <th>العنوان</th>
              <th>الموقع</th>
              <th>الفترة</th>
              <th>المنظم</th>
            </tr>
          </thead>
          <tbody>
            @foreach($latestCampaigns as $campaign)
            <tr>
              <td>{{ $campaign->title }}</td>
              <td>{{ $campaign->adress }}</td>
              <td>{{ $campaign->start_date->format('d-m-Y') }} → {{ $campaign->end_date->format('d-m-Y') }}</td>
              <td>{{ $campaign->organizer->name }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    @endif
  </div>


@endsection

@section('script')
<script>
      

    
</script>
 @endsection

 