<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [AuthController::class, 'index'])->name('login.form');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


    Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles');
    Route::post('/vehicles', [VehicleController::class, 'store']);
    Route::put('/vehicles/{vehicle}', [VehicleController::class, 'update']);
    Route::delete('/vehicles/{vehicle}', [VehicleController::class, 'destroy']);

    Route::get('/clients', [ClientController::class, 'index'])->name('clients');
    Route::post('/clients', [ClientController::class, 'store']);
    Route::put('/clients/{client}', [ClientController::class, 'update']);
    Route::delete('/clients/{client}', [ClientController::class, 'destroy']);
});
