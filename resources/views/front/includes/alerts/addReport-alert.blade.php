<div class="modal fade addReport-notification" id="addReportModal" tabindex="-1" role="dialog" aria-labelledby="addReportModalTitle" aria-hidden="true">
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

                    <p id="addReport-message" class="fw-bolder">في هذه النافذة يمكنك اضافة تقرير عن المهمة التابعة لك وستعتبر المهمة عندها مكتملة..</p>
                </div>

                <form id="addReport-form" class="addReport-form-notification text-start" action="{{route('add.report',$task->id)}}" method="POST">
                    @csrf
                        
                        <!-- التقرير -->
                        <div class="mb-3">
                            <label for="report" class="form-label">التقرير</label>
                            <textarea class="form-control @error('report') is-invalid @enderror" id="report" name="report" rows="3" placeholder="أدخل وصف المهمة" required>{{ old('report') }}</textarea>
                            @error('report')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                     
                    <div class="text-center">
                        <button type="submit" class="btn rounded-3 bg-gradient-success mx-1 text-white confirm-ajax-submit">
                            رفع التقرير
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