@extends('layouts.admin.body')

@section('css')
 
 @endsection

@section('content')
 <div class="content pt-5 mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
      <h3>➕ إنشاء حملة جديدة</h3>
    </div>

    <div class="card shadow-sm">
      <div class="card-body">
        <form action="{{ route('campaigns.update',[$campaign->id]) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')


           <input type="hidden" id="offer-form-product_id" name="activity" value="1">

          <!-- العنوان -->
          <div class="mb-3">
            <label for="title" class="form-label">عنوان الحملة</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ $campaign->title }}" id="title" name="title" placeholder="أدخل عنوان الحملة" >
            @error('title')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <!-- الوصف -->
          <div class="mb-3">
            <label for="description" class="form-label">الوصف</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="أدخل وصف الحملة" >{{ $campaign->description }}</textarea>
            @error('description')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <!-- الموقع -->
          <div class="mb-3">
            <label for="location" class="form-label">الموقع</label>
            <input type="text" class="form-control @error('location') is-invalid @enderror" value="{{ $campaign->location }}" id="location" name="location" placeholder="أدخل موقع الحملة" >
            @error('location')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <!-- صورة الحملة -->
          <div class="mb-3">
            <label for="image" class="form-label">صورة الحملة</label>
            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" accept="image/*" >
            @error('image')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <!-- تاريخ البداية والنهاية -->
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="start_date" class="form-label">تاريخ البداية</label>
              <input type="date" class="form-control @error('start_date') is-invalid @enderror" value="{{ $campaign->start_date }}" id="start_date" name="start_date" >
              @error('start_date')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="col-md-6">
              <label for="end_date" class="form-label">تاريخ النهاية</label>
              <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" >
              @error('end_date')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          <!-- اختيار المنظم -->
          <div class="mb-3">
            <label for="organizer_id" class="form-label">تعيين منظم للحملة</label>
            <select class="form-select @error('organizer_id') is-invalid @enderror" id="organizer_id" name="organizer_id" >
              <option value="">اختر منظمًا</option>
              @foreach(getOrganizers() as $organizer)
                <option value="{{ $organizer->id }}" @if($campaign->organizer_id == $organizer->id) selected @endif > {{ $organizer->name }}</option>
              @endforeach
            </select>
            @error('organizer_id')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <!-- زر الحفظ -->
          <button type="submit" class="btn btn-success">💾 حفظ التعديلات</button>
        </form>
      </div>
    </div>

  </div>

@endsection

@section('script')
<script>
      

    
</script>
 @endsection

 