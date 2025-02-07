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
use App\Http\Controllers\HotelsController;
use App\Http\Controllers\RestaurantsController;
use App\Http\Controllers\SalonParlourController;
use App\Http\Controllers\ShoppingController;
use App\Http\Controllers\VehicleRentController;
use App\Http\Controllers\HouseRentController;
use App\Http\Controllers\PlotSalesController;
use App\Http\Controllers\TechniciansController;
use App\Http\Controllers\NurseryController;
use App\Http\Controllers\EntrepreneursController;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\InstitutionsController;
use App\Http\Controllers\BusScheduleController;
use App\Http\Controllers\TrainScheduleController;
use App\Http\Controllers\FireServiceController;
use App\Http\Controllers\PoliceStationController;
use App\Http\Controllers\ThanaController;
use App\Http\Controllers\BiddutOfficeController;
use App\Http\Controllers\CurierServiseController;
use App\Http\Controllers\TouristPlaceController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\TermsController;

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
//--------------------------------------------------------------------------------------------------------------------------------------------


//--------------------------------------------------------------------------------------------------------------------------------------------
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
    Route::post('/todaynews', [TodayNewsController::class, 'store'])->name('todaynews.store');
    Route::put('/todaynews/{id}', [TodayNewsController::class, 'update'])->name('todaynews.update');
    Route::delete('/todaynews', [TodayNewsController::class, 'destroy'])->name('todaynews.destroy');
    Route::post('/todaynews/upload', [TodayNewsController::class, 'upload'])->name('todaynews.upload');
    Route::post('/todaynews/delete', [TodayNewsController::class, 'delete'])->name('todaynews.delete');


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
    Route::post('/notifications/upload', [NotificationsController::class, 'upload'])->name('notifications.upload');
    Route::post('/notifications/delete', [NotificationsController::class, 'delete'])->name('notifications.delete');

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


    //Hotels Routes
    Route::get('/hoteles', [HotelsController::class, 'index'])->name('hoteles.index');
    Route::post('/hoteles', [HotelsController::class, 'store'])->name('hoteles.store');
    Route::put('/hoteles/{id}', [HotelsController::class, 'update'])->name('hoteles.update');
    Route::delete('/hoteles', [HotelsController::class, 'destroy'])->name('hoteles.destroy');

    //Restaurents Routes
    Route::get('/restaurants', [RestaurantsController::class, 'index'])->name('restaurants.index');
    Route::post('/restaurants', [RestaurantsController::class, 'store'])->name('restaurants.store');
    Route::put('/restaurants/{id}', [RestaurantsController::class, 'update'])->name('restaurants.update');
    Route::delete('/restaurants', [RestaurantsController::class, 'destroy'])->name('restaurants.destroy');

    //SalonParlour Routes
    Route::get('/salon_parlour', [SalonParlourController::class, 'index'])->name('salon_parlour.index');
    Route::post('/salon_parlour', [SalonParlourController::class, 'store'])->name('salon_parlour.store');
    Route::put('/salon_parlour/{id}', [SalonParlourController::class, 'update'])->name('salon_parlour.update');
    Route::delete('/salon_parlour', [SalonParlourController::class, 'destroy'])->name('salon_parlour.destroy');

    //Shopping Routes
    Route::get('/shopping', [ShoppingController::class, 'index'])->name('shopping.index');
    Route::post('/shopping', [ShoppingController::class, 'store'])->name('shopping.store');
    Route::put('/shopping/{id}', [ShoppingController::class, 'update'])->name('shopping.update');
    Route::delete('/shopping', [ShoppingController::class, 'destroy'])->name('shopping.destroy');

    //VehicleRent Routes
    Route::get('/vehicle_rent', [VehicleRentController::class, 'index'])->name('vehicle_rent.index');
    Route::post('/vehicle_rent', [VehicleRentController::class, 'store'])->name('vehicle_rent.store');
    Route::put('/vehicle_rent/{id}', [VehicleRentController::class, 'update'])->name('vehicle_rent.update');
    Route::delete('/vehicle_rent', [VehicleRentController::class, 'destroy'])->name('vehicle_rent.destroy');

    //HouseRent Routes
    Route::get('/house_rent', [HouseRentController::class, 'index'])->name('house_rent.index');
    Route::post('/house_rent', [HouseRentController::class, 'store'])->name('house_rent.store');
    Route::put('/house_rent/{id}', [HouseRentController::class, 'update'])->name('house_rent.update');
    Route::delete('/house_rent', [HouseRentController::class, 'destroy'])->name('house_rent.destroy');

    //PlotSales Routes
    Route::get('/plot_sales', [PlotSalesController::class, 'index'])->name('plot_sales.index');
    Route::post('/plot_sales', [PlotSalesController::class, 'store'])->name('plot_sales.store');
    Route::put('/plot_sales/{id}', [PlotSalesController::class, 'update'])->name('plot_sales.update');
    Route::delete('/plot_sales', [PlotSalesController::class, 'destroy'])->name('plot_sales.destroy');

    //Technicians Routes
    Route::get('/technicians', [TechniciansController::class, 'index'])->name('technicians.index');
    Route::post('/technicians', [TechniciansController::class, 'store'])->name('technicians.store');
    Route::put('/technicians/{id}', [TechniciansController::class, 'update'])->name('technicians.update');
    Route::delete('/technicians', [TechniciansController::class, 'destroy'])->name('technicians.destroy');

    //Nursery Routes
    Route::get('/nursery', [NurseryController::class, 'index'])->name('nursery.index');
    Route::post('/nursery', [NurseryController::class, 'store'])->name('nursery.store');
    Route::put('/nursery/{id}', [NurseryController::class, 'update'])->name('nursery.update');
    Route::delete('/nursery', [NurseryController::class, 'destroy'])->name('nursery.destroy');

    //Entrepreneurs Routes
    Route::get('/entrepreneurs', [EntrepreneursController::class, 'index'])->name('entrepreneurs.index');
    Route::post('/entrepreneurs', [EntrepreneursController::class, 'store'])->name('entrepreneurs.store');
    Route::put('/entrepreneurs/{id}', [EntrepreneursController::class, 'update'])->name('entrepreneurs.update');
    Route::delete('/entrepreneurs', [EntrepreneursController::class, 'destroy'])->name('entrepreneurs.destroy');

    //Teachers Routes
    Route::get('/teachers', [TeachersController::class, 'index'])->name('teachers.index');
    Route::post('/teachers', [TeachersController::class, 'store'])->name('teachers.store');
    Route::put('/teachers/{id}', [TeachersController::class, 'update'])->name('teachers.update');
    Route::delete('/teachers', [TeachersController::class, 'destroy'])->name('teachers.destroy');

    //Institutions Routes
    Route::get('/institutions', [InstitutionsController::class, 'index'])->name('institutions.index');
    Route::post('/institutions', [InstitutionsController::class, 'store'])->name('institutions.store');
    Route::put('/institutions/{id}', [InstitutionsController::class, 'update'])->name('institutions.update');
    Route::delete('/institutions', [InstitutionsController::class, 'destroy'])->name('institutions.destroy');


    //BusSchedule Routes
    Route::get('/bus', [BusScheduleController::class, 'index'])->name('bus.index');
    Route::post('/bus', [BusScheduleController::class, 'store'])->name('bus.store');
    Route::put('/bus/{id}', [BusScheduleController::class, 'update'])->name('bus.update');
    Route::delete('/bus', [BusScheduleController::class, 'destroy'])->name('bus.destroy');
    Route::post('/bus/upload', [BusScheduleController::class, 'upload'])->name('bus.upload');
    Route::post('/bus/delete', [BusScheduleController::class, 'delete'])->name('bus.delete');

    //TrainSchedule Routes
    Route::get('/train', [TrainScheduleController::class, 'index'])->name('train.index');
    Route::post('/train', [TrainScheduleController::class, 'store'])->name('train.store');
    Route::put('/train/{id}', [TrainScheduleController::class, 'update'])->name('train.update');
    Route::delete('/train', [TrainScheduleController::class, 'destroy'])->name('train.destroy');
    Route::post('/train/upload', [TrainScheduleController::class, 'upload'])->name('train.upload');
    Route::post('/train/delete', [TrainScheduleController::class, 'delete'])->name('train.delete');

    //FireService Routes
    Route::get('/fire_service', [FireServiceController::class, 'index'])->name('fire_service.index');
    Route::post('/fire_service', [FireServiceController::class, 'store'])->name('fire_service.store');
    Route::put('/fire_service/{id}', [FireServiceController::class, 'update'])->name('fire_service.update');
    Route::delete('/fire_service', [FireServiceController::class, 'destroy'])->name('fire_service.destroy');

    //PoliceStation Routes
    Route::get('/police_station', [PoliceStationController::class, 'index'])->name('police_station.index');
    Route::post('/police_station', [PoliceStationController::class, 'store'])->name('police_station.store');
    Route::put('/police_station/{id}', [PoliceStationController::class, 'update'])->name('police_station.update');
    Route::delete('/police_station', [PoliceStationController::class, 'destroy'])->name('police_station.destroy');

    //Thana Routes
    Route::get('/thana', [ThanaController::class, 'index'])->name('thana.index');
    Route::post('/thana', [ThanaController::class, 'store'])->name('thana.store');
    Route::put('/thana/{id}', [ThanaController::class, 'update'])->name('thana.update');
    Route::delete('/thana', [ThanaController::class, 'destroy'])->name('thana.destroy');

    //BiddutOffice Routes
    Route::get('/biddut_office', [BiddutOfficeController::class, 'index'])->name('biddut_office.index');
    Route::post('/biddut_office', [BiddutOfficeController::class, 'store'])->name('biddut_office.store');
    Route::put('/biddut_office/{id}', [BiddutOfficeController::class, 'update'])->name('biddut_office.update');
    Route::delete('/biddut_office', [BiddutOfficeController::class, 'destroy'])->name('biddut_office.destroy');

    //CurierServise Routes
    Route::get('/curier_servise', [CurierServiseController::class, 'index'])->name('curier_servise.index');
    Route::post('/curier_servise', [CurierServiseController::class, 'store'])->name('curier_servise.store');
    Route::put('/curier_servise/{id}', [CurierServiseController::class, 'update'])->name('curier_servise.update');
    Route::delete('/curier_servise', [CurierServiseController::class, 'destroy'])->name('curier_servise.destroy');

    //TouristPlace Routes
    Route::get('/tourist_place', [TouristPlaceController::class, 'index'])->name('tourist_place.index');
    Route::post('/tourist_place', [TouristPlaceController::class, 'store'])->name('tourist_place.store');
    Route::put('/tourist_place/{id}', [TouristPlaceController::class, 'update'])->name('tourist_place.update');
    Route::delete('/tourist_place', [TouristPlaceController::class, 'destroy'])->name('tourist_place.destroy');
    Route::post('/tourist_place/upload', [TouristPlaceController::class, 'upload'])->name('tourist_place.upload');
    Route::post('/tourist_place/delete', [TouristPlaceController::class, 'delete'])->name('tourist_place.delete');

    //ContactUs Routes
    Route::get('/contact_us', [ContactUsController::class, 'index'])->name('contact_us.index');
    Route::post('/contact_us', [ContactUsController::class, 'store'])->name('contact_us.store');
    Route::put('/contact_us/{id}', [ContactUsController::class, 'update'])->name('contact_us.update');
    Route::delete('/contact_us', [ContactUsController::class, 'destroy'])->name('contact_us.destroy');

    //PrivacyPolicy Routes
    Route::get('/privacy_policy', [PrivacyPolicyController::class, 'index'])->name('privacy_policy.index');
    Route::post('/privacy_policy', [PrivacyPolicyController::class, 'store'])->name('privacy_policy.store');
    Route::put('/privacy_policy/{id}', [PrivacyPolicyController::class, 'update'])->name('privacy_policy.update');
    Route::delete('/privacy_policy', [PrivacyPolicyController::class, 'destroy'])->name('privacy_policy.destroy');

    //Terms Routes
    Route::get('/terms', [TermsController::class, 'index'])->name('terms.index');
    Route::post('/terms', [TermsController::class, 'store'])->name('terms.store');
    Route::put('/terms/{id}', [TermsController::class, 'update'])->name('terms.update');
    Route::delete('/terms', [TermsController::class, 'destroy'])->name('terms.destroy');


    //Pages Routes
    Route::get('/emergencies', function () {
        return view('modules.Pages.Emergencies');
    })->middleware(['verified'])->name('emergencies');

    Route::get('/websites', function () {
        return view('modules.Pages.Websites');
    })->middleware(['verified'])->name('websites');







//--------------------------------------------------------------------------------------------------------------------------------------------
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
