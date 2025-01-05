<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::middleware(['web'])->group(function () {
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login');
});

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});
require __DIR__.'/auth.php';


