<?php

use App\Http\Controllers\NewsDeskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Controller;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


//Test Route
Route::get('/auth', [Controller::class, 'index'])->name('index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //Users Routes
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users', [UserController::class, 'destroy'])->name('users.destroy');


    //NewsDesk Routes
    Route::get('/news_desks', [NewsDeskController::class, 'index'])->name('news_desks.index');
    Route::get('/news_desks/create', [NewsDeskController::class, 'create'])->name('news_desks.create');
    Route::post('/news_desks', [NewsDeskController::class, 'store'])->name('news_desks.store');
    Route::get('/news_desks/{id}/edit', [NewsDeskController::class, 'edit'])->name('news_desks.edit');
    Route::post('/news_desks/{id}', [NewsDeskController::class, 'update'])->name('news_desks.update');
    Route::delete('/news_desks', [NewsDeskController::class, 'destroy'])->name('news_desks.destroy');


});

Route::fallback(function () {
    return '</br></br><center><h1>404 Not Found!</h1> </center>';
});


require __DIR__.'/auth.php';

require __DIR__.'/admin-auth.php';
