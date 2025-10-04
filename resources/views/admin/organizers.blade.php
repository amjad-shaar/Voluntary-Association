@extends('layouts.admin.body')

@section('css')
 
 @endsection

@section('content')

 <!-- Content -->
  <div class="content">
    <h2 class="mb-4">👥 قائمة منظمي الحملات</h2>
    @if($organizers->count() > 0)
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
                        <th>عدد الحملات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- مثال صف متطوع -->
                     @foreach($organizers as $organizer)
                     
                    <tr>
                        <td>{{$organizer->id}}</td>
                        <td>{{$organizer->name}}</td>
                        <td>{{$organizer->email}}</td>
                        <td>{{$organizer->phone}}</td>
                        <td>{{$organizer->adress}}</td>
                        <td>{{$organizer->created_at}}</td>
                        <td><span class="badge bg-success">{{$organizer->campaigns->count()}}</span></td>
                    </tr>
@endforeach
                    <!-- يمكن تكرار الصفوف حسب عدد المتطوعين -->
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    @else
        <p class="text-muted">لا توجد منطمين حملات بعد.</p>
    @endif
    
  </div>


@endsection

@section('script')
<script>
      

    
</script>
 @endsection

 