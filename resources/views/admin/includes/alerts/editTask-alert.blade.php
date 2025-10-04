<div class="modal fade editTask-notification" id="editTaskModal" tabindex="-1" role="dialog" aria-labelledby="editTaskModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered" role="document">
        <div class="modal-content card p-3 shadow-sm border-0 rounded-5">
            <div class="modal-header p-0 pb-3">
                <div class="modal-title fs-6 fw-bolder text-primary" id="modal-title-notification">المهام:</div>
                <button type="button" class="btn-close p-0 m-0 pb-2 fw-bolder fs-6 text-danger" data-bs-dismiss="modal" aria-label="Close">
                    <span class="fw-bolder text-dark" aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-3 text-center">

                    <p id="editTask-message" class="fw-bolder">في هذه النافذة يمكنك تعديل مهام الحملات.</p>
                </div>

                <form id="editTask-form" class="editTask-form-notification text-start" action="{{route('tasks.update',[$task->id])}}" method="POST">
                    @csrf
                    @method('PUT')
                       
                        <!-- العنوان -->
                        <div class="mb-3">
                            <label for="title" class="form-label">عنوان المهمة</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" id="title" name="title" placeholder="أدخل عنوان الحملة" >
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- الوصف -->
                        <div class="mb-3">
                            <label for="description" class="form-label">الوصف</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="أدخل وصف المهمة" >{{ old('description') }}</textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="required_volunteers" class="form-label">عدد المتطوعين المطلوب</label>
                            <input type="number" class="form-control @error('required_volunteers') is-invalid @enderror no-spin" 
                                    id="required_volunteers" name="required_volunteers" value="{{ old('required_volunteers') }}" >
                            @error('required_volunteers')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                     
                    <div class="row mb-3">
                        <div class="col-md-6">
                        <label for="execution_time" class="form-label">وقت التنفيذ</label>
                        <input type="time" class="form-control @error('execution_time') is-invalid @enderror" value="{{ old('execution_time') }}" id="execution_time" name="execution_time" >
                        @error('execution_time')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>

                    <!-- اختيار المنظم -->
                    <div class="mb-3">
                        <label for="status" class="form-label">حالة المهمة</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" >
                            <option value="pending" selected>في الانتظار</option>
                            <option value="in_progress">قيد العمل</option>
                            <option value="completed">مكتملة</option>
                            <option value="failed">فشلت</option>
                            <option value="cancelled">أُلغيت</option>
                        </select>
                        @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn rounded-3 bg-gradient-success mx-1 text-white confirm-ajax-submit">
                            تأكيد المهمة
                        </button>
                        <button type="button" class="btn rounded-3 bg-gradient-secondary mx-1 mt-0" data-bs-dismiss="modal">
                            تراجع
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>