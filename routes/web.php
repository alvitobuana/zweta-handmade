<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
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
=======
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomRequestController;
use App\Http\Controllers\OrderTrackingController;

// Frontend pages
Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/katalog', [ProductController::class, 'katalog'])->name('katalog');
Route::get('/produk/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/custom', [CustomRequestController::class, 'create'])->name('custom');
Route::post('/custom', [CustomRequestController::class, 'store'])->name('custom.store');
Route::get('/tracking', [OrderTrackingController::class, 'search'])->name('tracking');

// Authentication — hanya bisa diakses bila belum login (guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [\App\Http\Controllers\AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register.post');
});
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Protect admin routes: harus login DAN harus is_admin = true
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class, ['as' => 'admin']);
    Route::get('/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{id}', [\App\Http\Controllers\Admin\OrderController::class, 'show'])->name('admin.orders.show');
    Route::post('/orders/{order}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::get('/custom-requests', [\App\Http\Controllers\Admin\CustomRequestController::class, 'index'])->name('admin.customrequests.index');
    Route::post('/custom-requests/{customRequest}/status', [\App\Http\Controllers\Admin\CustomRequestController::class, 'updateStatus'])->name('admin.customrequests.updateStatus');
    Route::get('/customers', [\App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('admin.customers.index');
    Route::delete('/customers/{customer}', [\App\Http\Controllers\Admin\CustomerController::class, 'destroy'])->name('admin.customers.destroy');
    Route::get('/materials', [\App\Http\Controllers\Admin\MaterialController::class, 'index'])->name('admin.materials.index');
    Route::get('/materials/{material}/edit', [\App\Http\Controllers\Admin\MaterialController::class, 'edit'])->name('admin.materials.edit');
    Route::patch('/materials/{material}', [\App\Http\Controllers\Admin\MaterialController::class, 'update'])->name('admin.materials.update');
    Route::get('/production', [\App\Http\Controllers\Admin\ProductionController::class, 'index'])->name('admin.production');
});
>>>>>>> 7d3d76c5ac893614aeb83c1d057e180f21b81278
