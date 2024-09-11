<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccountController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');


Route::prefix('account')->group(function(){
    Route::get('/register', [AccountController::class, 'register'])->name('account.register');
    Route::post('/register-process', [AccountController::class, 'registerProcess'])->name('account.register.process');
    Route::get('/login', [AccountController::class, 'login'])->name('account.login');
});
