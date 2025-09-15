<?php

use Illuminate\Support\Facades\Route;
use 

Route::get('/', function () {
    return view('welcome');
});

// Admin routes
Route::get('admin/login', [AdminAuthController::class, 'show'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'login']);
Route::post('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Member routes
Route::get('member/login', [MemberAuthController::class, 'show'])->name('member.login');
Route::post('member/login', [MemberAuthController::class, 'login']);
Route::post('member/logout', [MemberAuthController::class, 'logout'])->name('member.logout');


Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', fn() => view('admin.dashboard'));
});

Route::middleware('auth:member')->group(function () {
    Route::get('/member/dashboard', fn() => view('member.dashboard'));
});
