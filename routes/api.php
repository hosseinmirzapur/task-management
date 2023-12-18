<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SubTaskController;
use App\Http\Controllers\TaskController;
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
    // todo: remember to include realtime notification feature
});

// Task
Route::middleware('auth:sanctum')->prefix('/task')->group(function () {
    Route::post('/', [TaskController::class, 'store']);
    Route::patch('/{taskId}', [TaskController::class, 'update']);
    Route::delete('/{taskId}', [TaskController::class, 'destroy']);
});

// SubTask
Route::middleware('auth:sanctum')->prefix('/subtask')->group(function () {
    Route::post('/', [SubTaskController::class, 'store']);
    Route::patch('/{subtaskId}', [SubTaskController::class, 'update']);
    Route::delete('/{subtaskId}', [SubTaskController::class, 'destroy']);

});

// Report
Route::middleware('auth:sanctum')->prefix('/report')->group(function () {

});
