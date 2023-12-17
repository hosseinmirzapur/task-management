<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Auth
Route::prefix('/auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

// User
Route::middleware('auth:sanctum')->prefix('/user')->group(function () {
    Route::get('/info', [UserController::class, 'info']);
    Route::patch('/', [UserController::class, 'update']);
    Route::patch('/change-pass', [UserController::class, 'changePass']);
});

// Notification
Route::middleware('auth:sanctum')->prefix('/notification')->group(function () {
    Route::post('/send', [NotificationController::class, 'send']);
    Route::post('/{notifId}/mark-as-seen', [NotificationController::class, 'markAsSeen']);
});

// Task
Route::middleware('auth:sanctum')->prefix('/task')->group(function () {

});

// SubTask
Route::middleware('auth:sanctum')->prefix('/sub-task')->group(function () {

});

// Report
Route::middleware('auth:sanctum')->prefix('/report')->group(function () {

});
