<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\UserController;

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

Route::middleware(['auth'])->group(function () {
    //Logout
    Route::post('/logout', [UserController::class, 'logout']);

    //Dashboard
    Route::get('/', [DashboardController::class, 'index']);

    //Show Employees List
    Route::get('/employees', [EmployeesController::class, 'index']);
});

Route::middleware(['guest'])->group(function () {
    //Show Login Form
    Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

    //Show Login Form
    Route::post('/authenticate', [UserController::class, 'authenticate'])->middleware('guest');
});
