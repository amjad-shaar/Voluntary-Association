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
