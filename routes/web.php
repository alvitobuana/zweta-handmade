<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomRequestController;
use App\Http\Controllers\OrderTrackingController;

// Frontend pages (Dynamic)
Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/katalog', [ProductController::class, 'katalog'])->name('katalog');
Route::get('/produk/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::post('/produk/{slug}/order', [ProductController::class, 'order'])->name('product.order')->middleware('auth');
Route::get('/custom', [CustomRequestController::class, 'create'])->name('custom');
Route::post('/custom', [CustomRequestController::class, 'store'])->name('custom.store');
Route::get('/tracking', [OrderTrackingController::class, 'search'])->name('tracking');
Route::post('/tracking/{code}/receipt', [OrderTrackingController::class, 'uploadReceipt'])->name('tracking.uploadReceipt');

// Frontend pages (Static Mockups / New Pages)
Route::get('/home', function () {
    return view('pages.home');
});
Route::get('/detail', function () {
    return view('pages.detail');
});
Route::get('/checkout', function () {
    return view('pages.checkout');
});
Route::get('/kontak', function () {
    return view('pages.kontak');
});

// Authentication — hanya bisa diakses bila belum login (guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Profile routes (require auth)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'profile']);
    Route::get('/edit', [UserController::class, 'edit']);
    Route::post('/profile', [UserController::class, 'update']);
});

// Protect admin routes: harus login DAN harus is_admin = true
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class, ['as' => 'admin']);
    Route::get('/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{id}', [\App\Http\Controllers\Admin\OrderController::class, 'show'])->name('admin.orders.show');
    Route::post('/orders/{order}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::post('/orders/{order}/verify', [\App\Http\Controllers\Admin\OrderController::class, 'verifyPayment'])->name('admin.orders.verifyPayment');
    Route::post('/orders/{order}/reject', [\App\Http\Controllers\Admin\OrderController::class, 'rejectPayment'])->name('admin.orders.rejectPayment');
    Route::get('/custom-requests', [\App\Http\Controllers\Admin\CustomRequestController::class, 'index'])->name('admin.customrequests.index');
    Route::post('/custom-requests/{customRequest}/status', [\App\Http\Controllers\Admin\CustomRequestController::class, 'updateStatus'])->name('admin.customrequests.updateStatus');
    Route::get('/customers', [\App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('admin.customers.index');
    Route::delete('/customers/{customer}', [\App\Http\Controllers\Admin\CustomerController::class, 'destroy'])->name('admin.customers.destroy');
    Route::get('/reports', [\App\Http\Controllers\Admin\ReportController::class, 'index'])->name('admin.reports.index');
    Route::get('/materials', [\App\Http\Controllers\Admin\MaterialController::class, 'index'])->name('admin.materials.index');
    Route::get('/materials/{material}/edit', [\App\Http\Controllers\Admin\MaterialController::class, 'edit'])->name('admin.materials.edit');
    Route::patch('/materials/{material}', [\App\Http\Controllers\Admin\MaterialController::class, 'update'])->name('admin.materials.update');
    Route::get('/production', [\App\Http\Controllers\Admin\ProductionController::class, 'index'])->name('admin.production');
});
