<?php

use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('clients', App\Http\Controllers\ClientController::class)
        ->except(['show']);
    Route::resource('estimates', App\Http\Controllers\EstimateController::class);
    Route::get('estimates/{estimate}/pdf', [App\Http\Controllers\EstimateController::class, 'pdf'])->name('estimates.pdf');
    Route::put('estimates/{estimate}/state', [App\Http\Controllers\EstimateController::class, 'state'])->name('estimates.state');

    Route::get('settings', [SettingsController::class, 'index'])->name('settings');
});
