<?php

use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccountController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');


Route::prefix('account')->group(function(){

    Route::get('/register', [AccountController::class, 'register'])->name('account.register');
    Route::post('/register-process', [AccountController::class, 'registerProcess'])->name('account.register.process');

    Route::get('/login', [AccountController::class, 'login'])->name('account.login');
    Route::post('/login-process', [AccountController::class, 'loginProcess'])->name('account.login.process');

    Route::get('/logout', [AccountController::class, 'logout'])->name('account.logout');

    Route::get('/profile', [AccountController::class, 'profile'])->name('account.profile')->middleware(RedirectIfAuthenticated::class);
    Route::put('/profile/update-process', [AccountController::class, 'updateProfile'])->name('account.profile.update.process')->middleware(RedirectIfAuthenticated::class);
    Route::put('/profile/update-password', [AccountController::class, 'updatePassword'])->name('account.profile.update.password')->middleware(RedirectIfAuthenticated::class);

});
