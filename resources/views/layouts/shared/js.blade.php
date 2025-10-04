<script src="{{asset('public/assets/js/core/jquery.js')}}"></script>
<script src="{{asset('public/assets/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('public/assets/js/animation-on-scroll.js')}}"></script>
<script src="{{asset('public/assets/js/script.js')}}"></script>



<script>
/*######################## start Notifications ###########################*/
// المتغيرات العامة
let visibleNotifications = 0;
const notificationHeight = 80; // ارتفاع كل إشعار

const calculateDisplayTime = (text) => {

    const AVG_READING_SPEED = 180;
    const MIN_TIME = 5000;
    const MAX_TIME = 30000;
    
    const wordCount = text.split(/\s+/).filter(w => w.length > 0).length;
    const readingTimeMs = (wordCount / AVG_READING_SPEED) * 60000;
    
    return Math.min(MAX_TIME, Math.max(MIN_TIME, readingTimeMs));
};
function showNotification(type) {
    // 1. إنشاء نسخة جديدة من القالب
    const template = document.getElementById(type + 'Template');
    const newNotification = template.cloneNode(true);
    newNotification.id = type + 'Notification_' + Date.now();
    newNotification.classList.add('show');
    // 2. إعداد تأثيرات الظهور الأولية
    newNotification.style.opacity = '0';
    newNotification.style.transform = 'translateX(30px)';
    newNotification.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';

    // 3. إضافة الإشعار إلى بداية الحاوية
    const container = document.getElementById('notificationContainer');
    container.insertBefore(newNotification, container.firstChild);
    
    // 4. تفعيل تأثير الظهور بعد إضافة العنصر
    setTimeout(() => {
        newNotification.style.display = 'block';
        newNotification.style.opacity = '1';
        newNotification.style.transform = 'translateX(0)';
    }, 50);
    
    // 5. تحديد الموضع الثابت في الأعلى
    newNotification.style.top = '20px';
    
    // 6. تحريك جميع الإشعارات الأخرى للأسفل
    moveAllNotificationsDown();
    
    // 7. زيادة العداد
    visibleNotifications++;
    
    // 8. إعداد وقت الإغلاق التلقائي
    const messageText = newNotification.querySelector('p').textContent;
    const closeTime = calculateDisplayTime(messageText);
    
    // 9. إعداد زر الإغلاق
    const closeButton = newNotification.querySelector('.btn-close');
    closeButton.addEventListener('click', function() {
        removeNotification(newNotification);
    });
    
    // 10. الإغلاق التلقائي
    setTimeout(function() {
        removeNotification(newNotification);
    }, closeTime);
}

function moveAllNotificationsDown() {
    const notifications = document.querySelectorAll('.notification-container .notification');
    notifications.forEach((notification, index) => {
        if (index > 0) { // تخطي الإشعار الجديد (الأول)
            notification.style.top = 20 + (index * (notificationHeight + 10)) + 'px';
        }
    });
}

function removeNotification(notificationElement) {
    // 1. إضافة تأثير الإخفاء
    notificationElement.style.opacity = '0';
    notificationElement.style.transform = 'translateX(30px) scale(0.95)';
    
    // 2. الانتظار حتى ينتهي الانتقال قبل الإزالة
    notificationElement.classList.add('hide');
    setTimeout(() => {
        notificationElement.remove();
        visibleNotifications--;
        updateNotificationsPosition();
    }, 400);
}

function updateNotificationsPosition() {
    const notifications = document.querySelectorAll('.notification-container .notification');
    notifications.forEach((notification, index) => {
        notification.style.top = 20 + (index * (notificationHeight + 10)) + 'px';
    });
}
/*######################## end Notifications ###########################*/

/*######################## start OnOnline --- OnOffline###########################*/
    document.getElementsByTagName("BODY")[0].onoffline = function(){
        $('.online').hide();
        $('.offline').show();
    };
    document.getElementsByTagName("BODY")[0].ononline = function(){
        $('.offline').hide();
        $('.online').show();
        setInterval(function(){$('.online').hide();}, 10000);
    };
/*######################## end OnOnline --- OnOffline###########################*/
 
</script>
@if(Session::has('notifyType'))
  <script>
    $( document ).ready(function() {
        let toastType="{{Session::get('notifyType')}}";
        let toastTrigger = document.getElementById(`${toastType}Template`);
        if (toastTrigger) {
            let toast = new bootstrap.Toast(toastTrigger);
            toast.show();
        }

       $(`#btn-${toastType}`).click();
    });
  </script>
@endif
