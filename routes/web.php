<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'admin'])->get('/admin-test', function () {
    return 'Selamat datang, Admin!';
});

use App\Http\Controllers\StockController;

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('stocks', StockController::class);
});

use App\Http\Controllers\TransactionController;

Route::middleware(['auth'])->group(function () {
    Route::resource('transactions', TransactionController::class);
});

use App\Http\Controllers\JournalController;

Route::middleware(['auth'])->group(function () {
    Route::resource('journals', JournalController::class);
});

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');