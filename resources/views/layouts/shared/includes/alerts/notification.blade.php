<button id="btn-warning" onclick="showNotification('warning')"></button>
<button id="btn-info" onclick="showNotification('info')"></button>
<button id="btn-secondary" onclick="showNotification('question')"></button>
<button id="btn-success" onclick="showNotification('success')"></button>
<button id="btn-danger" onclick="showNotification('danger')"></button>
<button id="btn-light" onclick="showNotification('loading')"></button>

<!-- حاوية الإشعارات -->
<div class="notification-container m-2 ms-3" id="notificationContainer">
    <!-- سيتم إضافة الإشعارات هنا ديناميكيًا -->
</div>

<!-- قوالب الإشعارات المخفية -->
<div id="templates" style="display:none;">
  <!-- نافذة إشعار تحذير -->
  <div id="warningTemplate" class="warning notification col-lg-4 col-md-6 col-9">
    <div class="alert alert-light fade show" role="alert">
      <strong class="fs-5 text-start">{{Session::get('notifyTitle')}}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      <p class="mb-0">{{Session::get('notifyMsg')}}</p>
    </div>
  </div>

  <!-- نافذة إشعار معلومات -->
  <div id="infoTemplate" class="info notification col-lg-4 col-md-6 col-9">
    <div class="alert alert-light fade show" role="alert">
      <strong class="fs-5 text-start">{{Session::get('notifyTitle')}}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      <p class="mb-0">{{Session::get('notifyMsg')}}</p>
    </div>
  </div>

  <!-- نافذة إشعار سؤال -->
  <div id="questionTemplate" class="question notification col-lg-4 col-md-6 col-9">
    <div class="alert alert-light fade show" role="alert">
      <strong class="fs-5 text-start">{{Session::get('notifyTitle')}}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      <p class="mb-0">{{Session::get('notifyMsg')}}</p>
    </div>
  </div>

  <!-- نافذة إشعار تأكيد -->
  <div id="successTemplate" class="success notification col-lg-4 col-md-6 col-9">
    <div class="alert alert-light fade show" role="alert">
      <strong class="fs-5 text-start">{{Session::get('notifyTitle')}}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      <p class="mb-0">{{Session::get('notifyMsg')}}</p>
    </div>
  </div>

  <!-- نافذة إشعار خطأ -->
  <div id="dangerTemplate" class="danger notification col-lg-4 col-md-6 col-9">
    <div class="alert alert-light fade show" role="alert">
      <strong class="fs-5 text-start">{{Session::get('notifyTitle')}}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      <p class="mb-0">{{Session::get('notifyMsg')}}</p>
    </div>
  </div>

  <!-- نافذة إشعار تحميل -->
  <div id="loadingTemplate" class="loading notification col-lg-4 col-md-6 col-9">
    <div class="alert alert-light fade show" role="alert">
      <strong class="fs-5 text-start">{{Session::get('notifyTitle')}}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      <p class="mb-0">{{Session::get('notifyMsg')}}</p>
    </div>
  </div>
</div>

<!-- إظهار رسالة عند فقدات الاتصال بالانترنت -->
<div class="offline rounded-4 text-center">
  <i class="bi bi-rss fa-fade text-danger m-2"></i>
  <p class="fw-bolder fs-5 m-2 d-block">يبدو أنك فقدت الأتصال بالأنترنت</p>
  <div class="blur-cover rounded-4"></div>
</div>

<!-- إظهار رسالة عند إعادة الاتصال بالانترنت -->
<div class="online rounded-4 text-center">
  <i class="bi bi-rss text-success m-2"></i>
  <p class="fw-bolder fs-5 m-2 d-block">تم أستعادة الأتصال بالأنترنت</p>
  <div class="blur-cover rounded-4"></div>
</div>