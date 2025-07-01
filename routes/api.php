<?php

// All routes have been moved to web.php
// This file is kept for reference but all routes are now defined without the /api prefix

/*
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Middleware\CheckCompanyAccess;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('forgot-password', [AuthController::class, 'forgotPassword']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
});

// Company routes with restricted access
Route::middleware(['auth:sanctum', CheckCompanyAccess::class])->group(function () {
    Route::apiResource('companies', CompanyController::class);
});
*/ 