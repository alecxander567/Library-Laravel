<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowerController;
use App\Models\Borrower;
use App\Models\Book;


Route::get('/', function () {
    return view('Landing');
});

Route::get('/home', function () {
    $borrowers = Borrower::with('book')->get();
    $books = Book::all();
    return view('Home', compact('borrowers', 'books'));
})->name('home');

Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
Route::post('/books/store', [BookController::class, 'store'])->name('books.store');
Route::put('/books/{id}/update', [BookController::class, 'update'])->name('books.update');
Route::delete('/books/{id}/delete', [BookController::class, 'destroy'])->name('books.destroy');
Route::post('/borrowers/store', [BorrowerController::class, 'store'])->name('borrowers.store');
Route::get('/top-books', [BookController::class, 'topBooks'])->name('books.top');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout.perform');
