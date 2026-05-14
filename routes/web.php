<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('products', ProductController::class);

    Route::prefix('inventory')->name('inventory.')->group(function () {
        Route::get('/movements', [InventoryController::class, 'movements'])->name('movements');
        Route::get('/movements/create', [InventoryController::class, 'createMovement'])->name('movements.create');
        Route::post('/movements', [InventoryController::class, 'storeMovement'])->name('movements.store');

        Route::middleware('role:admin')->group(function () {
            Route::get('/movements/{movement}/edit', [InventoryController::class, 'editMovement'])->name('movements.edit');
            Route::put('/movements/{movement}', [InventoryController::class, 'updateMovement'])->name('movements.update');
            Route::delete('/movements/{movement}', [InventoryController::class, 'destroyMovement'])->name('movements.destroy');
        });

        Route::get('/stock', [InventoryController::class, 'stock'])->name('stock');
    });

    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/invoice', [ReportController::class, 'invoice'])->name('invoice');
        Route::get('/invoice/pdf', [ReportController::class, 'generatePDF'])->name('invoice.pdf');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
