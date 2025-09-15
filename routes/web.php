<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\MemberAuthController;
use App\Http\Controllers\Admin\BookController;

Route::get('/', function () {
    return view('welcome');
});

// Admin Authentication routes
Route::get('admin/login', [AdminAuthController::class, 'show'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'login']);
Route::post('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Member Authentication routes
Route::get('member/register', [MemberAuthController::class, 'showRegisterForm'])->name('member.register');
Route::post('member/register', [MemberAuthController::class, 'register']);

Route::get('member/login', [MemberAuthController::class, 'showLoginForm'])->name('member.login');
Route::post('member/login', [MemberAuthController::class, 'login']);

Route::post('member/logout', [MemberAuthController::class, 'logout'])->name('member.logout');

// Admin Routes
Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', fn() => view('admin.dashboard'))->name('dashboard');
    Route::resource('books', BookController::class);
});

// Member Routes
Route::middleware('auth:member')->group(function () {
    Route::get('/member/dashboard', fn() => view('member.dashboard'));
})->name('member.dashboard');


