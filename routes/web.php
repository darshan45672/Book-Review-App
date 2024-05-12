<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'user'], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/register', [AccountController::class, 'showRegister'])->name('account.showRegister');
        Route::post('/register', [AccountController::class, 'userRegister'])->name('account.userRegister');

        Route::get('/login', [AccountController::class, 'showLogin'])->name('account.showLogin');
        Route::post('/login', [AccountController::class, 'userAuthenticate'])->name('account.userAuthenticate');
    });
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/profile', [AccountController::class, 'showProfile'])->name('account.showProfile');
        Route::post('/update-profile', [AccountController::class, 'userProfileUpdate'])->name('account.userProfileUpdate');
        Route::get('/logout', [AccountController::class, 'logOut'])->name('account.logOut');
        Route::get('/books', [BookController::class, 'index'])->name('books.index');
        Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
        Route::get('/books/edit/{id}', [BookController::class, 'edit'])->name('books.edit');
        Route::post('/books/edit/{id}', [BookController::class, 'update'])->name('books.update');
        Route::delete('/books/delete', [BookController::class, 'destroy'])->name('books.destroy');
        Route::post('/books/store', [BookController::class, 'store'])->name('books.store');
    });
});