<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;
use Illuminate\Support\Facades\Route;

// Controllers for roles
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Waiter\DashboardController as WaiterDashboardController;
use App\Http\Controllers\Kasir\DashboardController as KasirDashboardController;
use App\Http\Controllers\Owner\DashboardController as OwnerDashboardController;

Route::get('/', function () {
    return view('welcome');
});

// This will be the main redirect after login
Route::get('/dashboard', RedirectController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\Admin\MenuController;

use App\Http\Controllers\Admin\RestaurantTableController;

use App\Http\Controllers\Admin\UserController;

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', AdminDashboardController::class)->name('dashboard');
    Route::resource('tables', RestaurantTableController::class);
    Route::resource('users', UserController::class);
    // Add other admin routes here
});

// Routes accessible by Admin and Kasir
Route::middleware(['auth', 'can.manage.menus'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('menus', MenuController::class);
});

use App\Http\Controllers\Waiter\OrderController;
use App\Http\Controllers\Waiter\ReportController as WaiterReportController;

// Waiter Routes
Route::middleware(['auth', 'waiter'])->prefix('waiter')->name('waiter.')->group(function () {
    Route::get('/dashboard', WaiterDashboardController::class)->name('dashboard');
    Route::get('select-table', [OrderController::class, 'select_table'])->name('orders.select_table');
    Route::resource('orders', OrderController::class);
    Route::resource('reports', WaiterReportController::class);
    // Add other waiter routes here
});

use App\Http\Controllers\Kasir\TransactionController;
use App\Http\Controllers\Kasir\ReportController;

// Cashier Routes
Route::middleware(['auth', 'kasir'])->prefix('kasir')->name('kasir.')->group(function () {
    Route::get('/dashboard', KasirDashboardController::class)->name('dashboard');
    Route::get('transactions/{transaction}/receipt', [TransactionController::class, 'receipt'])->name('transactions.receipt');
    Route::resource('transactions', TransactionController::class);
    Route::resource('reports', ReportController::class);
    // Add other cashier routes here
});

use App\Http\Controllers\Owner\ReportController as OwnerReportController;

// Owner Routes
Route::middleware(['auth', 'owner'])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/dashboard', OwnerDashboardController::class)->name('dashboard');
    Route::get('reports/best-selling', [OwnerReportController::class, 'bestSelling'])->name('reports.best-selling');
    Route::resource('reports', OwnerReportController::class);
    // Add other owner routes here
});

require __DIR__.'/auth.php';