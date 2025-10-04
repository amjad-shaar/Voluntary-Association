

<div class="modal fade join-task-notification" id="joinTaskModal" tabindex="-1" role="dialog" aria-labelledby="joinTaskModalTitle" aria-hidden="true">
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
                    <div id="join-task-item-title" class="text-gradient fs-5 text-danger mt-4 fw-bold"></div>
                    <p id="join-task-item-message" class="fw-bolder mt-4">هل ترغب في الانضمام والتطوع في هذه الحملة علما انه لا يمكنك التطوع إلا في حملة واحدة في وقت واحد ؟</p>
                </div>
            </div>
            <div class="modal-footer p-0 border-0 d-block pb-2">
                <form id="join-task-form" class="d-inline join-task-form-notification" action="{{route('join.task',$task->id)}}" method="POST">
                    @csrf
                    <button type="submit" class="btn rounded-3 bg-gradient-primary mx-1 text-white confirm-ajax-submit" data-action-type="volunteer" >موافق، قم بالحذف</button>
                </form>
                <button type="button" class="btn rounded-3 bg-gradient-secondary mx-1 mt-0" data-bs-dismiss="modal">تراجع</button>
            </div>
        </div>
    </div>
</div>