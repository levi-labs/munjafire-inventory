<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('layouts.main');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::controller(App\Http\Controllers\SupplierController::class)
    ->prefix('suppliers')
    ->group(function () {
        Route::get('/', 'index')->name('suppliers.index');
        Route::get('/create', 'create')->name('suppliers.create');
        Route::post('/store', 'store')->name('suppliers.store');
        Route::get('/{supplier}', 'show')->name('suppliers.show');
        Route::get('/{supplier}/edit', 'edit')->name('suppliers.edit');
        Route::put('/{supplier}', 'update')->name('suppliers.update');
        Route::delete('/{supplier}', 'destroy')->name('suppliers.destroy');
    });
