<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/home', function () {
    return view('pages.home');
});


Route::get('/login', function () {
    return view('pages.login');
});

Route::get('/register', function () {
    return view('pages.register');
});

Route::get('/katalog', function () {
    return view('pages.katalog');
});

Route::get('/detail', function () {
    return view('pages.detail');
});

Route::get('/custom', function () {
    return view('pages.custom');
});

Route::get('/checkout', function () {
    return view('pages.checkout');
});

Route::get('/tracking', function () {
    return view('pages.tracking');
});

Route::get('/kontak', function () {
    return view('pages.kontak');
});

// Auth (web)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// Profile routes (require auth)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'profile']);
    Route::get('/edit', [UserController::class, 'edit']);
    Route::post('/profile', [UserController::class, 'update']);
});

Route::get('/checkout', function () {
    return view('pages.checkout');
});