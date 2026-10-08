<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

// Route Beranda
Route::get('/', function () {
    return view('home'); // <-- tadinya '.home' hapus titiknya
})->name('home');

Route::view('/profil-kelas', 'profil-kelas')->name('profil-kelas');

// Route Data Buku (CRUD) - URUTAN PENTING!
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
Route::post('/books', [BookController::class, 'store'])->name('books.store');

Route::get('/books/{book}/preview', [BookController::class, 'preview'])->whereNumber('book')->name('books.preview');
Route::get('/books/{book}/edit', [BookController::class, 'edit'])->whereNumber('book')->name('books.edit');
Route::put('/books/{book}', [BookController::class, 'update'])->whereNumber('book')->name('books.update');
Route::delete('/books/{book}', [BookController::class, 'destroy'])->whereNumber('book')->name('books.destroy');

Route::get('/books/{book}', [BookController::class, 'show'])->whereNumber('book')->name('books.show');