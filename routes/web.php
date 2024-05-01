<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\WebAuthMiddleware;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

// routes/web.php

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');

Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('register.post');

Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::middleware(WebAuthMiddleware::class)->group(function() {
// Route untuk menampilkan halaman pengeluaran
Route::get('/show-expenses', [ExpenseController::class, 'showExpensesPage'])->name('expenses.show');

// Rute lainnya untuk operasi CRUD EXPENSES
Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index');
Route::get('/expenses/create', [ExpenseController::class, 'create'])->name('expenses.create');
Route::post('/expenses', [ExpenseController::class, 'storeView'])->name('expenses.store');
Route::get('/expenses/{expense}/edit', [ExpenseController::class, 'edit'])->name('expenses.edit');
Route::put('/expenses/{expense}', [ExpenseController::class, 'update'])->name('expenses.update');
Route::delete('/expenses/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');
Route::get('/expenses/filter-and-display', [ExpenseController::class, 'filterAndDisplayByDateRange'])->name('expenses.filter-and-display');

// Route untuk menampilkan halaman pengeluaran
Route::get('/show-incomes', [IncomeController::class, 'showIncomesPage'])->name('incomes.show');

// Rute lainnya untuk operasi CRUD INCOMES
Route::get('/incomes', [IncomeController::class, 'index'])->name('incomes.index');
Route::get('/incomes/create', [IncomeController::class, 'create', 'store'])->name('incomes.create');
Route::post('/incomes', [IncomeController::class, 'storeView'])->name('incomes.store');
Route::get('/incomes/{income}/edit', [IncomeController::class, 'edit'])->name('incomes.edit');
Route::put('/incomes/{income}', [IncomeController::class, 'update'])->name('incomes.update');
Route::delete('/incomes/{income}', [IncomeController::class, 'destroy'])->name('incomes.destroy');
Route::get('/incomes/filter-and-display', [IncomeController::class, 'filterAndDisplayByDateRange'])->name('incomes.filter-and-display');
});