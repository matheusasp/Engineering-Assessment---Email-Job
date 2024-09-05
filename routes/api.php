<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\AuthController;

// Public Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');



// Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/emails', [EmailController::class, 'store']);
    Route::get('/emails/{id}', [EmailController::class, 'show']);
    Route::put('/emails/{id}', [EmailController::class, 'update']);
    Route::get('/emails', [EmailController::class, 'index']);
    Route::delete('/emails/{id}', [EmailController::class, 'destroy']);
});
