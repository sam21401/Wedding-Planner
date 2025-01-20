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



Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    Route::get('/guests/csv', [GuestController::class, 'generateCsv']);
    Route::get('/guests/precentage', [GuestController::class, 'getResponsePercentage']);
    Route::get('/guests',[GuestController::class,'index']);
    Route::post('/guests',[GuestController::class,'store']);
    Route::get('/guests/{guest}',[GuestController::class,'show']);
    Route::put('/guests/{guest}',[GuestController::class,'update']);
    Route::delete('/guests/{guest}',[GuestController::class,'destroy']);

    Route::apiResource('posts', PostController::class);

    Route::get('/tasks', [TaskController::class, 'index']);
    Route::post('/posts/{post}/tasks', [TaskController::class, 'store']);
    Route::get('/tasks/{task}', [TaskController::class, 'show']);
    Route::put('/tasks/{task}', [TaskController::class, 'update']);
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);
    Route::get('/tasks/collaborator/{collaborator}', [TaskController::class, 'tasksByCollaborator']);


    Route::get('/tasks/{task}/notes', [TaskNoteController::class, 'index']); 
    Route::post('/tasks/{task}/notes', [TaskNoteController::class, 'store']); 
    Route::get('/tasks/{task}/notes/{note}', [TaskNoteController::class, 'show']);
    Route::put('/tasks/{task}/notes/{note}', [TaskNoteController::class, 'update']); 
    Route::delete('/tasks/{task}/notes/{note}', [TaskNoteController::class, 'destroy']);


    Route::get('/posts/{post}/collaborators', [CollaboratorController::class, 'index']); 
    Route::post('/posts/{post}/collaborators', [CollaboratorController::class, 'store']);
    Route::get('/collaborators/{collaborator}', [CollaboratorController::class, 'show']); 
    Route::put('/collaborators/{collaborator}', [CollaboratorController::class, 'update']); 
    Route::delete('/collaborators/{collaborator}', [CollaboratorController::class, 'destroy']);
});
Route::get('/post/{post}/landingpage', [PostController::class, 'landingPage']);


