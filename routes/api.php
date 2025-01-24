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
use OpenApi\Annotations as OA;

/**
 * @OA\Info(title="API Documentation", version="1.0")
 */

/**
 * @OA\Tag(name="Authentication", description="Endpoints for authentication")
 * @OA\Tag(name="Users", description="User management endpoints")
 * @OA\Tag(name="Guests", description="Guest-related operations")
 * @OA\Tag(name="Posts", description="Operations related to posts")
 * @OA\Tag(name="Tasks", description="Task management endpoints")
 * @OA\Tag(name="Collaborators", description="Collaborator management")
 */

/**
 * @OA\Post(
 *     path="/login",
 *     summary="User login",
 *     tags={"Authentication"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"email","password"},
 *             @OA\Property(property="email", type="string", format="email"),
 *             @OA\Property(property="password", type="string", format="password")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Successful login")
 * )
 */


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

/**
 * @OA\Post(
 *     path="/register",
 *     summary="User registration",
 *     tags={"Authentication"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name","email","password"},
 *             @OA\Property(property="name", type="string"),
 *             @OA\Property(property="email", type="string", format="email"),
 *             @OA\Property(property="password", type="string", format="password")
 *         )
 *     ),
 *     @OA\Response(response=201, description="User registered successfully")
 * )
 */



Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);


     /**
     * @OA\Get(
     *     path="/user",
     *     summary="Get logged-in user details",
     *     tags={"Users"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(response=200, description="User details returned successfully")
     * )
     */


    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/user/email', [AuthController::class, 'changeEmail'])->middleware('auth:sanctum');    

    Route::get('/guests/csv', [GuestController::class, 'generateCsv']);
    Route::get('/guests/precentage', [GuestController::class, 'getResponsePercentage']);
    Route::get('/guests',[GuestController::class,'index']);
    Route::post('/guests',[GuestController::class,'store']);
    Route::get('/guests/{guest}',[GuestController::class,'show']);
    Route::put('/guests/{guest}',[GuestController::class,'update']);
    Route::delete('/guests/{guest}',[GuestController::class,'destroy']);


     /**
     * @OA\ApiResource(
     *     path="/posts",
     *     summary="Manage posts",
     *     tags={"Posts"}
     * )
     */

    Route::apiResource('posts', PostController::class);


    /**
     * @OA\ApiResource(
     *     path="/tasks",
     *     summary="Manage tasks",
     *     tags={"Tasks"}
     * )
     */
    Route::apiResource('tasks', TaskController::class);

     /**
     * @OA\ApiResource(
     *     path="/collaborators",
     *     summary="Manage collaborators",
     *     tags={"Collaborators"}
     * )
     */
    Route::apiResource('collaborators', CollaboratorController::class);
});
Route::get('/post/{post}/landingpage', [PostController::class, 'landingPage']);


