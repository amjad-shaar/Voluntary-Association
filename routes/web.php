<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminCampaignController;
use App\Http\Controllers\Admin\AdminTaskController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Front\CampaignController;
use App\Http\Controllers\Front\TaskController;
use App\Http\Controllers\Front\VolunteerController;
use App\Http\Controllers\Front\HomeController;



define('PAGINATION_COUNT',10);

 Route::get('/', [HomeController::class, 'home'])->name('home');

Route::middleware('auth')->group(function () {

    Route::get('/profile', function () {
        return view('front.profile');
    })->name('profile');

     // تسجيل الخروج
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('join-task/{id}', [VolunteerController::class, 'joinTask'])->name('join.task');
});
Route::post('add.report/{id}', [TaskController::class, 'addReport'])->name('add.report');



// مسارات الضيوف (غير المسجلين)
Route::middleware('guest')->group(function () {
    // تسجيل الدخول
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    
    // التسجيل
    Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
    
    Route::post('register', [AuthController::class, 'register'])->name('register');
 
});
Route::get('campaigns/{id}', [CampaignController::class, 'campaign'])->name('campaign');
Route::get('campaigns', [CampaignController::class, 'campaigns'])->name('campaigns');
Route::get('tasks/{id}', [TaskController::class, 'task'])->name('task');
########### Admin ###########

Route::group(['prefix' => 'dashboard'], function () {
    Route::get('volunteers', [AdminUserController::class, 'volunteers'])->name('volunteers');
    Route::get('organizers', [AdminUserController::class, 'organizers'])->name('organizers');
    
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
  
    Route::resource('tasks', AdminTaskController::class)->except(['show']);
    Route::resource('campaigns', AdminCampaignController::class)->except(['show']);
    
});