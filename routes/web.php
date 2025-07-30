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

Route::controller(App\Http\Controllers\CategoryController::class)
    ->prefix('categories')
    ->group(function () {
        Route::get('/', 'index')->name('categories.index');
        Route::get('/create', 'create')->name('categories.create');
        Route::post('/store', 'store')->name('categories.store');
        Route::get('/{category}', 'show')->name('categories.show');
        Route::get('/{category}/edit', 'edit')->name('categories.edit');
        Route::put('/{category}', 'update')->name('categories.update');
        Route::delete('/{category}', 'destroy')->name('categories.destroy');
    });

Route::controller(App\Http\Controllers\EoqSettingController::class)
    ->prefix('eoq_settings')
    ->group(function () {
        Route::get('/', 'index')->name('eoq_settings.index');
        Route::get('/create', 'create')->name('eoq_settings.create');
        Route::post('/store', 'store')->name('eoq_settings.store');
        Route::get('/{eoqSetting}', 'show')->name('eoq_settings.show');
        Route::get('/{eoqSetting}/edit', 'edit')->name('eoq_settings.edit');
        Route::put('/{eoqSetting}', 'update')->name('eoq_settings.update');
        Route::delete('/{eoqSetting}', 'destroy')->name('eoq_settings.destroy');
    });

Route::controller(App\Http\Controllers\UserController::class)
    ->prefix('users')
    ->group(function () {
        Route::get('/', 'index')->name('users.index');
        Route::get('/create', 'create')->name('users.create');
        Route::post('/store', 'store')->name('users.store');
        Route::get('/{user}', 'show')->name('users.show');
        Route::get('/{user}/edit', 'edit')->name('users.edit');
        Route::put('/{user}', 'update')->name('users.update');
        Route::delete('/{user}', 'destroy')->name('users.destroy');
        Route::post('/{user}/reset-password', 'resetPassword')->name('users.resetPassword');
    });
