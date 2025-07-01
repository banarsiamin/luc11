<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Middleware\CheckCompanyAccess;

Route::get('/', function () {
    return redirect('/login');
});

// Guest routes
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', function () {
        return view('register');
    });
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
});

// Dashboard route
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Protected company routes
Route::middleware(['auth', CheckCompanyAccess::class])->group(function () {
    Route::get('/company', function () {
        return view('company');
    });
    
    Route::get('/company/add', function () {
        return view('company_add');
    });
    
    Route::get('/company/list', [CompanyController::class, 'index']);
    
    Route::get('/company/{id}/edit', [CompanyController::class, 'show']);
    
    Route::apiResource('companies', CompanyController::class);
});
