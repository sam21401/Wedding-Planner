<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\HomeController; // Import HomeController

// Obsługa logowania
Route::middleware(['web'])->group(function () {
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login');
});

// Strona główna
Route::get('/', [HomeController::class, 'index']);

// Import dodatkowych tras, jeśli są potrzebne
require __DIR__.'/auth.php';
