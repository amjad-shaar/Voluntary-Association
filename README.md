<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>
<h2>دليل جلب وتشغيل المشروع من GitHub</h2>

<h3>1. قبل البدء</h3>
<ul>
  <li>تثبيت Git على جهازك.</li>
  <li>تثبيت PHP وComposer لمشاريع Laravel.</li>
  <li>تثبيت Node.js و npm (إن كان المشروع يحتوي على assets).</li>
  <li>حساب GitHub وصلاحية الوصول للريبو (public أو private).</li>
</ul>

<h3>2. استنساخ الريبو لأول مرة (Clone)</h3>
<b>HTTPS:</b>
<pre>
git clone https://github.com/USERNAME/REPOSITORY.git
cd REPOSITORY
</pre>

<b>SSH:</b>
<pre>
git clone git@github.com:USERNAME/REPOSITORY.git
cd REPOSITORY
</pre>

<h3>3. تحديث نسخة محلية موجودة (Pull)</h3>
<pre>
git pull origin main
</pre>

<h3>4. إنشاء فرع جديد</h3>
<pre>
git checkout -b feature/my-feature
git add .
git commit -m "وصف التغييرات"
git push -u origin feature/my-feature
</pre>

<h3>5. بعد جلب الكود — تشغيل مشروع Laravel</h3>
<ol>
  <li>نسخ ملف البيئة: <code>cp .env.example .env</code></li>
  <li>تثبيت حزم PHP: <code>composer install</code></li>
  <li>تثبيت حزم JS: <code>npm install &amp;&amp; npm run dev</code></li>
  <li>توليد مفتاح التطبيق: <code>php artisan key:generate</code></li>
  <li>تحديث قاعدة البيانات: إعداد .env ثم <code>php artisan migrate --seed</code></li>
  <li>ربط مجلد التخزين: <code>php artisan storage:link</code></li>
  <li>تشغيل السيرفر: <code>php artisan serve</code></li>
</ol>

<h3>6. نصائح أمان</h3>
<ul>
  <li>لا ترفع ملفات حساسة (.env) إلى GitHub.</li>
  <li>استخدم SSH للراحة.</li>
  <li>قبل <code>git push</code> نفذ <code>git pull --rebase origin branch</code> لتجنب merge commits غير مرغوب فيها.</li>
</ul>

<h3>7. أوامر سريعة</h3>
<ul>
  <li>استنساخ: <code>git clone git@github.com:me/voluntary-association.git</code></li>
  <li>تحديث الفرع الرئيسي: <code>git checkout main &amp;&amp; git pull origin main</code></li>
  <li>رفع تغييراتك: <code>git add . &amp;&amp; git commit -m "وصف" &amp;&amp; git push origin feature/xyz</code></li>
</ul>

<h2>شرح مبسط لمشروع إدارة الحملات التطوعية</h2>

<h3>1️⃣ فكرة المشروع</h3>
<p>نظام ويب لإدارة الحملات التطوعية، يتيح للمؤسسات:</p>
<ul>
  <li>إنشاء الحملات التطوعية في مجالات مختلفة (نظافة، تعليم، مساعدات).</li>
  <li>تسجيل المتطوعين وإدارتهم.</li>
  <li>توزيع المتطوعين على المهام.</li>
  <li>متابعة تقارير المتطوعين لكل مهمة.</li>
  <li>إدارة الصلاحيات بين أدوار مختلفة: <b>مدير، منظم حملة، متطوع</b>.</li>
</ul>

<h3>2️⃣ الأدوار والصلاحيات</h3>
<ul>
  <li><b>Admin (مدير الموقع)</b>: إدارة المستخدمين، الحملات، المهام، والتقارير. تعيين منظمين.</li>
  <li><b>Organizer (منظم حملة)</b>: إنشاء وتعديل الحملات والمهام، متابعة تقارير المتطوعين.</li>
  <li><b>Volunteer (متطوع)</b>: تصفح الحملات والمهام، الانضمام، ورفع التقارير.</li>
</ul>
<p>الصلاحيات يتم التحكم بها باستخدام <b>Policies/Gates</b> أو مكتبة <b>Spatie Permission</b>.</p>

<h3>3️⃣ الهيكلية العامة للموديلات</h3>
<ul>
  <li><b>User</b>: يمثل المستخدمين. علاقات: <code>tasks()</code>, <code>reports()</code>, <code>campaigns()</code>.</li>
  <li><b>Campaign</b>: يمثل الحملات التطوعية. علاقات: <code>tasks()</code>, <code>volunteers()</code>, <code>owner()</code>, <code>organizer()</code>.</li>
  <li><b>Task</b>: يمثل المهام داخل كل حملة. علاقات: <code>campaign()</code>, <code>volunteers()</code>, <code>reports()</code>.</li>
  <li><b>TaskUser</b>: جدول وسيط بين User و Task لتخزين حالة المتطوع في المهمة.</li>
  <li><b>Report</b>: يمثل تقارير المتطوعين. علاقات: <code>task()</code>, <code>user()</code>.</li>
</ul>

<h3>4️⃣ مسارات المشروع (Routes)</h3>
<ul>
  <li><b>مسارات الضيوف:</b> login، register.</li>
  <li><b>مسارات المتطوعين:</b> profile، join-task/{id}، add.report/{id}.</li>
  <li><b>مسارات الحملات والمهام:</b> campaigns، campaigns/{id}، tasks/{id}.</li>
  <li><b>مسارات لوحة تحكم Admin:</b> dashboard/، dashboard/users، dashboard/campaigns، dashboard/tasks.</li>
</ul>

<h3>5️⃣ طريقة عمل التطبيق</h3>
<ol>
  <li>المستخدم يزور الموقع كضيف أو مسجل.</li>
  <li>إنشاء حملة من قبل المسؤول أو المنظم.</li>
  <li>إضافة المهام للحملة بواسطة المنظم.</li>
  <li>انضمام المتطوعين للمهام مع قيود على العدد والحالة.</li>
  <li>رفع ومراجعة التقارير بعد انتهاء المهمة.</li>
  <li>لوحة Admin تعرض إحصائيات: عدد المستخدمين، الحملات، المهام، والتقارير، وأحدث المستخدمين والحملات.</li>
</ol>

<h3>6️⃣ ملاحظات تقنية</h3>
<ul>
  <li>استخدام <b>Blade Templates</b> لجميع الواجهات.</li>
  <li>التحقق من المدخلات باستخدام <b>Form Requests</b>.</li>
  <li>التحكم بالصلاحيات باستخدام <b>Policies/Gates</b> أو <b>Spatie Permission</b>.</li>
  <li>Pivot table <b>TaskUser</b> لتتبع حالة كل متطوع في المهمة.</li>
  <li>استخدام <b>hasManyDeep</b> للوصول لجميع المتطوعين في كل المهام الخاصة بالحملة.</li>
</ul>
