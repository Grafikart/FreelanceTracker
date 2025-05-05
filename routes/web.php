<?php

use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('clients', App\Http\Controllers\ClientController::class)
        ->except(['show']);

    // Estimates
    Route::resource('estimates', App\Http\Controllers\EstimateController::class);
    Route::get('estimates/{estimate}/pdf', [App\Http\Controllers\EstimateController::class, 'pdf'])->name('estimates.pdf');
    Route::put('estimates/{estimate}/state', [App\Http\Controllers\EstimateController::class, 'state'])->name('estimates.state');

    // Reporting
    Route::resource('projects', App\Http\Controllers\ProjectController::class);
    Route::resource('tasks', App\Http\Controllers\TaskController::class);

    // Settings
    Route::get('settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('settings', [SettingsController::class, 'store']);
});
