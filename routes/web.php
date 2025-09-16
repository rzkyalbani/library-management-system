<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\MemberAuthController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\BorrowController;
use App\Http\Controllers\Admin\FineController;  

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
    
    Route::resource('members', MemberController::class);
    Route::post('members/{member}/toggle-active', [MemberController::class, 'toggleActive'])->name('members.toggle-active');

    Route::resource('borrows', BorrowController::class)->except(['edit', 'update']);
    Route::post('borrows/{borrow}/return', [BorrowController::class, 'returnBook'])->name('borrows.return');

    Route::resource('fines', FineController::class);
    Route::post('fines/{fine}/mark-as-paid', [FineController::class, 'markAsPaid'])->name('fines.markAsPaid');
});

// Member Routes
Route::middleware('auth:member')->prefix('member')->name('member.')->group(function () {
    Route::get('/member/dashboard', fn() => view('member.dashboard'))->name('dashboard');
});


