<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokterControllers;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('dktr', DokterControllers::class);
Route::resource('login', LoginController::class);
Route::resource('register', RegisterController::class);
Route::post('actionregister', [RegisterController::class, 'actionregister'])->name('actionregister');
Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');
Route::post('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');
Route::post('forgot-password', [AuthController::class, 'sendResetLink'])->name('sendResetLink');
Route::get('forgotpassword', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
