<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AccountController::class, 'showRegister'])->name('account.showRegister');
Route::post('/register', [AccountController::class, 'userRegister'])->name('account.userRegister');

Route::get('/login', [AccountController::class, 'showLogin'])->name('account.showLogin');