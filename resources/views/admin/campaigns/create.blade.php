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
        <form action="{{ route('campaigns.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <!-- العنوان -->
          <div class="mb-3">
            <label for="title" class="form-label">عنوان الحملة</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" id="title" name="title" placeholder="أدخل عنوان الحملة" required>
            @error('title')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <!-- الوصف -->
          <div class="mb-3">
            <label for="description" class="form-label">الوصف</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="أدخل وصف الحملة" required>{{ old('description') }}</textarea>
            @error('description')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <!-- الموقع -->
          <div class="mb-3">
            <label for="location" class="form-label">الموقع</label>
            <input type="text" class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}" id="location" name="location" placeholder="أدخل موقع الحملة" required>
            @error('location')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <!-- صورة الحملة -->
          <div class="mb-3">
            <label for="image" class="form-label">صورة الحملة</label>
            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" accept="image/*" required>
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
              <input type="date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date') }}" id="start_date" name="start_date" required>
              @error('start_date')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="col-md-6">
              <label for="end_date" class="form-label">تاريخ النهاية</label>
              <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" required>
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
            <select class="form-select @error('organizer_id') is-invalid @enderror" id="organizer_id" name="organizer_id" required>
              <option value="">اختر منظمًا</option>
              @foreach(getOrganizers() as $organizer)
                <option value="{{ $organizer->id }}" @if(old('organizer_id') == $organizer->id) selected @endif>{{ $organizer->name }}</option>
              @endforeach
            </select>
            @error('organizer_id')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <!-- زر الحفظ -->
          <button type="submit" class="btn btn-success">💾 حفظ الحملة</button>
        </form>
      </div>
    </div>

  </div>

@endsection

@section('script')
<script>
      

    
</script>
 @endsection

 