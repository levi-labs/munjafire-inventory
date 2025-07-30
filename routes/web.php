<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('layouts.main');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
