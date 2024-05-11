<?php

use App\Http\Controllers\AccountController;
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
    });
});