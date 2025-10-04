@extends('layouts.front.body')

@section('css')
  <style>
 .profile-header {
      background: linear-gradient(135deg, #0d6efd, #20c997);
      color: #fff;
      padding: 40px 20px;
      border-radius: 15px;
      text-align: center;
      margin-bottom: 30px;
    }
    .profile-header img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      border: 4px solid #fff;
      margin-bottom: 15px;
    }
     .badge-status {
      font-size: 0.9rem;
      padding: 0.6rem 1rem;
      border-radius: 50rem;
    }
    .section-title {
      font-weight: bold;
      color: #333;
      margin-bottom: 20px;
    }
    .card {
      border-radius: 15px;
    }
    .volunteer-status {
      font-size: 0.9rem;
      padding: 5px 10px;
      border-radius: 20px;
    }
    .status-active {
      background: #d1e7dd;
      color: #0f5132;
    }
    .status-done {
      background: #f8d7da;
      color: #842029;
    }
  </style>
 @endsection

@section('content')
 <div class="container py-5">

    <!-- Profile Header -->
    <div class="profile-header shadow-sm">
      <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="User Avatar">
      <h3 class="fw-bold">محمد أحمد</h3>
      <p class="mb-1">📧 mohammed@example.com</p>
      <p class="mb-1">📱 +20123456789</p>
      <span class="badge bg-info">{{auth()->user()->getRole()}}</span>
      <p class="mt-2">تاريخ الانضمام: 15 يناير 2024</p>
    </div>

    <!-- User Info -->
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card shadow-sm p-3">
          <h5 class="section-title">معلومات الحساب</h5>
          <ul class="list-unstyled">
            <li><strong>الاسم:</strong> محمد أحمد</li>
            <li><strong>البريد:</strong> mohammed@example.com</li>
            <li><strong>الهاتف:</strong> +20123456789</li>
            <li><strong>الدور:</strong> {{auth()->user()->getRole()}}</li>
          </ul>
          <a href="#" class="btn btn-outline-primary btn-sm mt-3 w-100">✏️ تعديل البيانات</a>
          <a href="#" class="btn btn-outline-secondary btn-sm mt-2 w-100">🔑 تغيير كلمة المرور</a>
        </div>
      </div>

      <!-- Volunteer Activities -->
      <div class="col-md-8">
        <div class="card shadow-sm p-3">
          <h5 class="section-title">مشاركتي في الحملات</h5>
          <div class="table-responsive">
            <table class="table table-striped align-middle">
              <thead class="table-light">
                <tr>
                  <th>الحملة</th>
                  <th>المهمة</th>
                  <th>الحالة</th>
                  <th>التقرير</th>
                </tr>
              </thead>
              <tbody>
                @if(auth()->user()->tasks->count() > 0)
                @foreach(auth()->user()->tasks as $task)
                <tr>
                  <td>{{ $task->campaign->title }}</td>
                  <td>{{ $task->title }}</td>
                  <td>
                    <span class="badge  @if($task->pivot->status == 'in_progress')bg-info @elseif($task->pivot->status == 'completed')bg-success @elseif($task->pivot->status == 'failed' || $task->pivot->status == 'cancelled')bg-danger @else bg-warning @endif text-light badge-status">{{$task->pivot->status}}</span>
                  </td>
                  <td>
                   
                      <a href="{{route('task',$task->id)}}" class="btn btn-sm btn-outline-info"> رفع التقرير</a>
                  </td>
                </tr>
                @endforeach
                @endif
               
              </tbody>
            </table>
          </div>
        </div>

        <!-- Settings -->
        <div class="card shadow-sm p-3 mt-4">
          <h5 class="section-title">إعدادات الحساب</h5>
          <div class="d-flex justify-content-between">
            <a href="#" class="nav-link fw-bold px-0" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="bi bi-box-arrow-left fs-5"></i>
              <span class="">الخروج </span>
            </a> 
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @if(auth()->user()->role == 'admin' || auth()->user()->role == 'organizer')
            <a href="{{route('dashboard')}}" class="btn btn-success">لوحة التحكم</a>
            @endif
          </div>
        </div>
      </div>
    </div>

  </div>
 
@endsection

@section('script')
<script>
      

    
</script>
 @endsection

 