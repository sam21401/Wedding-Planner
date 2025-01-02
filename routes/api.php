<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\CollaboratorController;
use App\Http\Controllers\TaskController;


Route::apiResource('posts', PostController::class);



//
//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');


Route::apiResource('guests', GuestController::class);

Route::apiResource('posts', PostController::class);

Route::apiResource('collaborators', CollaboratorController::class);

Route::apiResource('tasks', TaskController::class);


Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
