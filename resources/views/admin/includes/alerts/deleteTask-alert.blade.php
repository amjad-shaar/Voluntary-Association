

<div class="modal fade delete-task-notification" id="deleteTaskModal" tabindex="-1" role="dialog" aria-labelledby="deleteTaskModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content card p-3 shadow-sm border-0 rounded-5">
            <div class="modal-header p-0 pb-3">
                <div class="modal-title fs-6 fw-bolder fs-6 text-danger" id="modal-title-notification">تحذير:</div>
                <button type="button" class="btn-close p-0 m-0 pb-2 fw-bolder fs-6 text-danger" data-bs-dismiss="modal" aria-label="Close">
                    <span class="fw-bolder text-dark" aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-3 text-center">
                    <i class="fs-1 fa fa-bell text-danger"></i>
                    <div id="delete-task-item-title" class="text-gradient fs-5 text-danger mt-4 fw-bold"></div>
                    <p id="delete-task-item-message" class="fw-bolder mt-4">هل تريد حذف هذه المهمة والغاء جميع المتطوعين التابعين لها ... هل تريد ذلك ؟</p>
                </div>
            </div>
            <div class="modal-footer p-0 border-0 d-block pb-2">
                <form id="delete-task-form" class="d-inline delete-task-form-notification" action="{{route('tasks.destroy',$task->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn rounded-3 bg-gradient-danger mx-1 text-white confirm-ajax-submit" data-action-type="delete" >موافق، قم بالحذف</button>
                </form>
                <button type="button" class="btn rounded-3 bg-gradient-secondary mx-1 mt-0" data-bs-dismiss="modal">تراجع</button>
            </div>
        </div>
    </div>
</div>