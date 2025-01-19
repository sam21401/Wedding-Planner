<?php

use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\GuestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CollaboratorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskNoteController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\VerifyEmailController;


Route::apiResource('collaborators', CollaboratorController::class);

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.store');

Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');



Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');



Route::get('/auth/{provider}',[SocialAuthController::class, 'redirect'])->middleware('guest');
Route::get('/auth/{provider}/callback',[SocialAuthController::class, 'callback'])->middleware('guest');

Route::get('/email/guest/accept/{guest}',[GuestController::class,'accept'])->name('guest.accept');
Route::get('/email/guest/decline/{guest}',[GuestController::class,'decline'])->name('guest.decline');



Route::middleware(['web'])->group(function () {


    Route::apiResource('tasks', TaskController::class);
});


Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    Route::get('/guests/csv', [GuestController::class, 'generateCsv']);
    Route::get('/guests',[GuestController::class,'index']);
    Route::post('/guests',[GuestController::class,'store']);
    Route::get('/guests/{guest}',[GuestController::class,'show']);
    Route::put('/guests/{guest}',[GuestController::class,'update']);
    Route::delete('/guests/{guest}',[GuestController::class,'destroy']);

    Route::post('/posts', [PostController::class, 'store']);
    Route::put('/posts/{post}', [PostController::class, 'update']);
    Route::get('/posts/{post}', [PostController::class, 'show']);
    Route::delete('/posts/{post}', [PostController::class, 'delete']);


});
Route::get('/post/{post}/landingpage', [PostController::class, 'landingPage']);


