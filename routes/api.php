<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ApiAuthMiddleware;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/users', [UserController::class, 'register']);
Route::post('/users/login', [UserController::class, 'login']);

// Protected routes
Route::middleware(ApiAuthMiddleware::class)->group(function() {
    // User routes
    Route::get('/users/getupdate', [UserController::class, 'get']);
    Route::patch('/users/getupdate', [UserController::class, 'update']);
    Route::delete('/users/logout', [UserController::class, 'logout']);

    // Expense routes
    Route::get('/expenses/filter', [ExpenseController::class, 'filterByDateRange']);
    Route::post('/expenses', [ExpenseController::class, 'store']); // Route for adding expense
    Route::put('/expenses/{expense}', [ExpenseController::class, 'update']); // Route for updating expense
    Route::apiResource('expenses', ExpenseController::class);

    // Income routes
    Route::get('/incomes/filter', [IncomeController::class, 'filterByDateRange']);
    Route::post('/incomes', [IncomeController::class, 'store']); // Route for adding income
    Route::put('/incomes/{income}', [IncomeController::class, 'update']); // Route for updating income
    Route::apiResource('incomes', IncomeController::class);
});