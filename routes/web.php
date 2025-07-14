<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ContractController;
use App\Models\Service;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contracts', [ContractController::class, 'index']);
Route::get('/contracts/{contract}', [ContractController::class, 'show']);

Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/customers/{customer}', [CustomerController::class, 'show']);
Route::post('/customers', [CustomerController::class, 'create']);
Route::patch('/customers/{customer}', [CustomerController::class, 'update']);




?>