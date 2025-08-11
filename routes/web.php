<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\AdminController;

// الصفحة الترحيبية
Route::get('/', function () {
    return view('welcome');
});

// الصفحة الرئيسية
Route::get('/home', function () {
    return view('home');
})->name('home');

// لوحة التحكم
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// المبيعات
Route::resource('sales', SalesController::class)->middleware('auth');

// الصفحات الشخصية
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// صفحة إدارية
Route::get('/somepath', [AdminController::class, 'index'])->middleware('auth');

// المنتجات
Route::resource('products', ProductController::class)->middleware('auth');

// الفواتير
Route::resource('invoices', InvoiceController::class)->middleware('auth');

// التقارير
Route::middleware('auth')->group(function () {
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/pdf', [ReportController::class, 'exportPdf'])->name('reports.pdf');
});

// المستخدمين والإعدادات
Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class);
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::get('/settings/edit', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
});


require __DIR__.'/auth.php';
