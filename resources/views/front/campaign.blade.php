@extends('layouts.front.body')

@section('css')
  <style>
    body {
      font-family: 'Tajawal', sans-serif;
      background-color: #f8f9fa;
    }
    .campaign-header {
      position: relative;
      border-radius: 15px;
      overflow: hidden;
    }
    .campaign-header img {
      width: 100%;
      height: 300px;
      object-fit: cover;
      filter: brightness(0.7);
    }
    .campaign-header .overlay {
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      color: #fff;
      background: rgba(0,0,0,0.4);
    }
    .card {
      border-radius: 15px;
    }
  </style>
 @endsection

@section('content')

 <div class="container py-4">

  <!-- Header -->
  <div class="campaign-header mb-4">
    <img src="{{ $campaign->image ? asset('storage/'.$campaign->image) : 'https://via.placeholder.com/1200x300?text=Campaign' }}" alt="Campaign Image">
    <div class="overlay text-center">
      <h1 class="fw-bold">{{ $campaign->title }}</h1>
      <p class="mb-1">{{ $campaign->location }}</p>
      <span class="badge bg-{{ now()->lt($campaign->end_date) ? 'success' : 'secondary' }}">
        {{ now()->lt($campaign->end_date) ? 'نشطة' : 'منتهية' }}
      </span>
    </div>
  </div>

  <!-- Details -->
  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <h5 class="fw-bold">📖 وصف الحملة</h5>
      <p>{{ $campaign->description }}</p>

      <div class="row">
        <div class="col-md-4">
          <p><strong>📍 الموقع:</strong> {{ $campaign->location }}</p>
        </div>
        <div class="col-md-4">
          <p><strong>🗓 تاريخ البداية:</strong> {{ $campaign->start_date->format('d-m-Y') }}</p>
        </div>
        <div class="col-md-4">
          <p><strong>🗓 تاريخ النهاية:</strong> {{ $campaign->end_date->format('d-m-Y') }}</p>
        </div>
      </div>

      <p><strong>👤 المنظم:</strong> {{ $campaign->owner?->name ?? 'غير محدد' }}</p>
    </div>
  </div>

  <!-- Tasks -->
  <div class="card shadow-sm mb-4">
    <div class="card-header bg-light fw-bold">📝 المهام المرتبطة بالحملة</div>
    <div class="card-body">
      
      @if($campaign->tasks->count() > 0)
        <div class="table-responsive">
          <table class="table table-striped align-middle">
            <thead>
              <tr>
                <th>العنوان</th>
                <th>الوصف</th>
                <th>عدد المطلوب</th>
                <th>المشتركين</th>
                <th>وقت التنفيذ</th>
                <th>إجراءات</th>
              </tr>
            </thead>
            <tbody>
              @foreach($campaign->tasks as $task)
                <tr>
                  <td>{{ $task->title }}</td>
                  <td>{{ $task->description }}</td>
                  <td>{{ $task->required_volunteers }}</td>
                  <td>{{ $task->volunteers->count() }}</td>
                  <td>{{ $task->execution_time }}</td>
                  <td>
                    <a href="{{ route('task', $task->id) }}" class="btn btn-sm btn-info">عرض</a>
                   
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <span class="badge text-bg-info text-light m-2 p-1 fs-5">{{ $campaign->tasks->count()}} مهمة</span>
      @else
        <p class="text-muted">لا توجد مهام مرتبطة بهذه الحملة.</p>
      @endif
    </div>
  </div>

  <!-- Volunteers -->
  <div class="card shadow-sm mb-4">
    <div class="card-header bg-light fw-bold">👥 المتطوعون المشاركون</div>
    <div class="card-body">
      @if($campaign->volunteers->count() > 0)
      
        <ul class="list-group my-3">
          @foreach($campaign->volunteers as $volunteer)
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ $volunteer->name }}
              <span class="text-muted">{{ $volunteer->email }}</span>
            </li>
          @endforeach
        </ul>
        <span class="badge text-bg-info text-light m-2 p-1 fs-5">{{ $campaign->volunteers->count() }} متطوع</span>
      @else
        <p class="text-muted">لا يوجد متطوعون بعد.</p>
      @endif
    </div>
  </div>

  <!-- Actions -->
  <div class="d-flex gap-2">
    @can('update', $campaign)
      <a href="{{ route('campaigns.edit', $campaign->id) }}" class="btn bg-gradient-warning">✏️ تعديل الحملة</a>
    @endcan
    @can('delete', $campaign)
      <button type="button" class="btn bg-gradient-danger mx-1" data-bs-toggle="modal" 
      data-bs-target="#deleteCampaignModal">
          🗑 حذف الحملة
      </button>
    @endcan
    @can('create',  App\Models\Task::class)
      <button type="button" class="btn bg-gradient-success mx-1" data-bs-toggle="modal" 
      data-bs-target="#addTaskModal">
          ➕ إضافة مهمة
      </button>
      @include('admin.includes.alerts.addTask-alert')
    @include('admin.includes.alerts.deleteCampaign-alert')
    @endcan
  </div>

</div>



@endsection

@section('script')
<script>
      

    
</script>
 @endsection

 