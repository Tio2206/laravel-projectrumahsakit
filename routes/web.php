<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokterControllers;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;

// Home Route
Route::get('/', fn() => view('welcome'))->name('home');

// Authentication Routes
Route::controller(RegisterController::class)->group(function () {
    Route::resource('register', RegisterController::class)->only(['index', 'store']);
    Route::post('actionregister', 'actionregister')->name('actionregister');
});

Route::controller(LoginController::class)->group(function () {
    Route::resource('login', LoginController::class)->only(['index', 'store']);
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('actionlogin', 'actionlogin')->name('actionlogin');
    Route::post('actionlogout', 'actionlogout')->name('actionlogout')->middleware('auth');
});

// Password Reset Routes
Route::controller(AuthController::class)->group(function () {
    Route::post('forgot-password', 'sendResetLink')->name('sendResetLink');
    Route::get('forgotpassword', 'forgotPassword')->name('forgotPassword');
    Route::get('/reset-password/{token}', 'resetPasswordPage')->name('password.reset');
    Route::post('/reset-password', 'updatePassword')->name('password.update');
});

// Doctor Resource Routes
Route::middleware(['auth', CheckRole::class])->group(function () {
    Route::resource('dktr', DokterControllers::class);
});

// Ruangan Resource Routes
Route::middleware(['auth', CheckRole::class])->group(function () {
    Route::resource('ruangan', RuanganController::class);
});

// Pasien Resource Routes
Route::middleware(['auth', CheckRole::class])->group(function () {
    Route::resource('pasien', PasienController::class);
});

// Profile Routes (Requires Authentication)
Route::middleware('auth')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/profile', 'view')->name('profile.view');
        Route::put('/profile/update', 'update')->name('profile.update');
    });
});
