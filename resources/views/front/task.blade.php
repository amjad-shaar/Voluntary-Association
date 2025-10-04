@extends('layouts.front.body')

@section('css')
   <style>
    body {
      background-color: #f4f6f9;
      font-family: 'Tajawal', sans-serif;
    }
    .task-header {
      background: linear-gradient(90deg, #4f46e5, #9333ea);
      color: #fff;
      border-radius: 1rem 1rem 0 0;
      padding: 2rem;
    }
    .task-card {
      border-radius: 1rem;
      overflow: hidden;
      box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }
    .badge-status {
      font-size: 0.9rem;
      padding: 0.6rem 1rem;
      border-radius: 50rem;
    }
    .action-buttons a, 
    .action-buttons button {
      min-width: 100px;
    }
  </style>
 @endsection

@section('content')

<div class="container py-5">
  <div class="task-card bg-white">
    
    <!-- الهيدر -->
    <div class="task-header">
      <h2 class="fw-bold mb-1">تفاصيل المهمة</h2>
      <p class="mb-0 opacity-75 fs-4">الحملة : {{$task->campaign->title}}</p>
    </div>

    <!-- المحتوى -->
    <div class="p-4 p-md-5">
      <!-- العنوان -->
      <div class="mb-4">
        <h6 class="text-muted">عنوان المهمة</h6>
        <p class="fs-4 fw-semibold text-dark">{{$task->title}}</p>
      </div>

      <!-- الوصف -->
      <div class="mb-4">
        <h6 class="text-muted">الوصف</h6>
        <p class="text-secondary fs-6">{{$task->description}}</p>
      </div>
 

      <!-- الحالة -->
      <div class="mb-4">
        <h6 class="text-muted">الحالة</h6>
        <span class="badge  @if($task->status == 'in_progress')bg-info @elseif($task->status == 'completed')bg-success @elseif($task->status == 'failed' || $task->status == 'cancelled')bg-danger @else bg-warning @endif text-light badge-status">{{$task->getStatus()}}</span>
        <!-- مثال للحالة المنجزة -->
        <!-- <span class="badge bg-success badge-status">منجزة</span> -->
      </div>
 
      <!-- المتطوعين -->
      <div class="row g-4">
        <div class="col-md-6">
          <div class="p-3 bg-light rounded shadow-sm">
            <h6 class="text-muted">عدد المتطوعين المطلوب</h6>
            <p class="mb-0 text-dark fw-medium">{{$task->required_volunteers}}</p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="p-3 bg-light rounded shadow-sm">
            <h6 class="text-muted">عدد المتطوعين الشواغر</h6>
            <p class="mb-0 text-dark fw-medium">{{$task->required_volunteers - $task->volunteers->count()}}</p>
          </div>
        </div>
      </div>

<br>
      <!-- التواريخ -->
      <div class="row g-4 ">
        <div class="col-md-6">
          <div class="p-3 bg-light rounded shadow-sm">
            <h6 class="text-muted">وقت التنفيذ</h6>
            <p class="mb-0 text-dark fw-medium">{{$task->execution_time}}</p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="p-3 bg-light rounded shadow-sm">
            <h6 class="text-muted">تاريخ الإنشاء</h6>
            <p class="mb-0 text-dark fw-medium">{{$task->created_at->format('d-m-Y')}}</p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="p-3 bg-light rounded shadow-sm">
            <h6 class="text-muted">آخر تحديث</h6>
            <p class="mb-0 text-dark fw-medium">{{$task->updated_at->format('d-m-Y')}}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- الأكشنات -->
    <div class="p-4 bg-light d-flex justify-content-between flex-wrap gap-2 action-buttons">
      <div>
        <button type="button" class="btn bg-gradient-primary mx-1" data-bs-toggle="modal" 
          data-bs-target="#joinTaskModal">
          أنضمام
        </button>
        @can('update', $task)
        <button type="button" class="btn bg-gradient-warning mx-1" data-bs-toggle="modal" 
          data-bs-target="#editTaskModal">
            تعديل المهمة
        </button>
        @endcan
        @can('delete', $task)
        <button type="button" class="btn bg-gradient-danger mx-1" data-bs-toggle="modal" 
          data-bs-target="#deleteTaskModal">
          حذف
        </button>
        @endcan
        
        <button type="button" class="btn bg-gradient-success mx-1" data-bs-toggle="modal" 
          data-bs-target="#addReportModal">
          رفع التقرير
        </button>

      </div>
      <a href="{{route('campaign',$task->campaign_id)}}" class="btn btn-secondary">رجوع للقائمة</a>
    </div>

  </div>
</div>

@include('admin.includes.alerts.editTask-alert')
@include('admin.includes.alerts.deleteTask-alert')
@include('front.includes.alerts.joinTask-alert')
@include('front.includes.alerts.addReport-alert')
@endsection

@section('script')
<script>
      

    
</script>
 @endsection

 