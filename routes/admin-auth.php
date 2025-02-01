<?php

use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredAdminController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminStaffController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\HospitalsController;
use App\Http\Controllers\DiagnosticCenterController;
use App\Http\Controllers\BloodDonorsController;
use App\Http\Controllers\BloodNeedersController;
use App\Http\Controllers\TodayNewsController;
use App\Http\Controllers\JobNewsController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\SlidersController;
use App\Http\Controllers\ScrollsController;

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware('guest:admin')->group(function () {
    Route::get('/', function () {
        return view('admin.auth.login');
    });
    Route::get('register', [RegisteredAdminController::class, 'create'])
        ->name('register');
    Route::post('register', [RegisteredAdminController::class, 'store']);
    Route::get('login', [AdminLoginController::class, 'create'])
        ->name('login');

    //AdminAuth Routes
    Route::post('login', [AdminLoginController::class, 'store']);
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

//Test Route
Route::get('/test', function () {
    return view('dashboard.dashboard');
})->name('test');

Route::get('/page', function () {
    return view('modules.Users.UserList');
})->name('page');

Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard.dashboard');
    })->middleware(['verified'])->name('dashboard');


    //Doctors Routes
    Route::get('/doctors', [DoctorsController::class, 'index'])->name('doctors.index');
    Route::post('/doctors', [DoctorsController::class, 'store'])->name('doctors.store');
    Route::put('/doctors/{id}', [DoctorsController::class, 'update'])->name('doctors.update');
    Route::delete('/doctors', [DoctorsController::class, 'destroy'])->name('doctors.destroy');

    //Hospitals Routes
    Route::get('/hospitals', [HospitalsController::class, 'index'])->name('hospitals.index');
    Route::post('/hospitals', [HospitalsController::class, 'store'])->name('hospitals.store');
    Route::put('/hospitals/{id}', [HospitalsController::class, 'update'])->name('hospitals.update');
    Route::delete('/hospitals', [HospitalsController::class, 'destroy'])->name('hospitals.destroy');

    //Diagnostic Center Routes
    Route::get('/diagnostics', [DiagnosticCenterController::class, 'index'])->name('diagnostics.index');
    Route::post('/diagnostics', [DiagnosticCenterController::class, 'store'])->name('diagnostics.store');
    Route::put('/diagnostics/{id}', [DiagnosticCenterController::class, 'update'])->name('diagnostics.update');
    Route::delete('/diagnostics', [DiagnosticCenterController::class, 'destroy'])->name('diagnostics.destroy');

    //Blood Donors Routes
    Route::get('/donors', [BloodDonorsController::class, 'index'])->name('donors.index');
    Route::post('/donors', [BloodDonorsController::class, 'store'])->name('donors.store');
    Route::put('/donors/{id}', [BloodDonorsController::class, 'update'])->name('donors.update');
    Route::delete('/donors', [BloodDonorsController::class, 'destroy'])->name('donors.destroy');

    //Blood Needers Routes
    Route::get('/needers', [BloodNeedersController::class, 'index'])->name('needers.index');
    Route::post('/needers', [BloodNeedersController::class, 'store'])->name('needers.store');
    Route::put('/needers/{id}', [BloodNeedersController::class, 'update'])->name('needers.update');
    Route::delete('/needers', [BloodNeedersController::class, 'destroy'])->name('needers.destroy');

    //Today News Routes
    Route::get('/todaynews', [TodayNewsController::class, 'index'])->name('todaynews.index');
    Route::post('/todaynews/upload', [TodayNewsController::class, 'upload'])->name('todaynews.upload');
    Route::post('/todaynews', [TodayNewsController::class, 'store'])->name('todaynews.store');
    Route::put('/todaynews/{id}', [TodayNewsController::class, 'update'])->name('todaynews.update');
    Route::delete('/todaynews', [TodayNewsController::class, 'destroy'])->name('todaynews.destroy');

    //Job News Routes
    Route::get('/jobnews', [JobNewsController::class, 'index'])->name('jobnews.index');
    Route::post('/jobnews', [JobNewsController::class, 'store'])->name('jobnews.store');
    Route::put('/jobnews/{id}', [JobNewsController::class, 'update'])->name('jobnews.update');
    Route::delete('/jobnews', [JobNewsController::class, 'destroy'])->name('jobnews.destroy');

    //Notifications Routes
    Route::get('/notifications', [NotificationsController::class, 'index'])->name('notifications.index');
    Route::post('/notifications', [NotificationsController::class, 'store'])->name('notifications.store');
    Route::put('/notifications/{id}', [NotificationsController::class, 'update'])->name('notifications.update');
    Route::delete('/notifications', [NotificationsController::class, 'destroy'])->name('notifications.destroy');

    //Sliders Routes
    Route::get('/sliders', [SlidersController::class, 'index'])->name('sliders.index');
    Route::post('/sliders', [SlidersController::class, 'store'])->name('sliders.store');
    Route::put('/sliders/{id}', [SlidersController::class, 'update'])->name('sliders.update');
    Route::delete('/sliders', [SlidersController::class, 'destroy'])->name('sliders.destroy');

    //Scrolls Routes
    Route::get('/scrolls', [ScrollsController::class, 'index'])->name('scrolls.index');
    Route::post('/scrolls', [ScrollsController::class, 'store'])->name('scrolls.store');
    Route::put('/scrolls/{id}', [ScrollsController::class, 'update'])->name('scrolls.update');
    Route::delete('/scrolls', [ScrollsController::class, 'destroy'])->name('scrolls.destroy');







    //Users Routes
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users', [UserController::class, 'destroy'])->name('users.destroy');


    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [AdminProfileController::class, 'destroy'])->name('profile.destroy');

    //Admin Staff Routes
    Route::get('/staff', [AdminStaffController::class, 'index'])->name('staff.index');
    Route::post('/staff', [AdminStaffController::class, 'store'])->name('staff.store');
    Route::put('/staff/{id}', [AdminStaffController::class, 'update'])->name('staff.update');
    Route::delete('/staff', [AdminStaffController::class, 'destroy'])->name('staff.destroy');
    Route::put('/staff/pass/{id}', [AdminStaffController::class, 'update_password'])->name('staff.update_password');

    //User Roles Routes
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/{id}/permissions', [RoleController::class, 'getPermissions'])->name('roles.permissions');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::put('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles', [RoleController::class, 'destroy'])->name('roles.destroy');

    //User Permissions Routes
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::put('/permissions/{id}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('/permissions', [PermissionController::class, 'destroy'])->name('permissions.destroy');


    //AdminAuth Routes
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AdminLoginController::class, 'destroy'])
        ->name('logout');
});
