<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'admin'])->get('/admin-test', function () {
    return 'Selamat datang, Admin!';
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('stocks', StockController::class);
    Route::post('/stocks-update-prices', [StockController::class, 'updatePrices'])->name('stocks.update-prices');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('transactions', TransactionController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('journals', JournalController::class);
});