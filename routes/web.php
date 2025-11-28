<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;

Route::get('/', function () {
    return view('Landing');
});

Route::get('/home', function () {
    return view('Home');
})->name('home');

Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout.perform');
