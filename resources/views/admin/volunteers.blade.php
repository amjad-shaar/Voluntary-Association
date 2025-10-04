@extends('layouts.admin.body')

@section('css')
 
 @endsection

@section('content')

 <!-- Content -->
  <div class="content">
    <h2 class="mb-4">👥 قائمة المتطوعين</h2>
    @if($volunteers->count() > 0)
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>البريد الإلكتروني</th>
                        <th>رقم الهاتف</th>
                        <th>العنوان</th>
                        <th>تاريخ التسجيل</th>
                        <th>عدد مرات التطوع</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- مثال صف متطوع -->
                     @foreach($volunteers as $volunteer)
                     
                    <tr>
                        <td>{{$volunteer->id}}</td>
                        <td>{{$volunteer->name}}</td>
                        <td>{{$volunteer->email}}</td>
                        <td>{{$volunteer->phone}}</td>
                        <td>{{$volunteer->adress}}</td>
                        <td>{{$volunteer->created_at}}</td>
                        <td><span class="badge bg-success">{{$volunteer->tasks->count()}}</span></td>
                    </tr>
@endforeach
                    <!-- يمكن تكرار الصفوف حسب عدد المتطوعين -->
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    @else
        <p class="text-muted">لا توجد متطوعين بعد.</p>
    @endif
    
  </div>


@endsection

@section('script')
<script>
      

    
</script>
 @endsection

 