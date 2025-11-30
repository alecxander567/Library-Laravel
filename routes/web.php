<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return view('Landing');
});

Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
Route::get('/home', [BookController::class, 'index'])->name('home');
Route::post('/books/store', [BookController::class, 'store'])->name('books.store');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout.perform');
