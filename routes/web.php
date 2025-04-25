<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InventoryEntryController;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/products', ProductController::class);

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [App\Http\Controllers\UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users', [App\Http\Controllers\UserController::class, 'index'])->name('admin.users.index'); // Ejemplo index route
});
Route::resource('/inventoryentries', InventoryEntryController::class);
