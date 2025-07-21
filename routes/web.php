<?php

use Illuminate\Support\Facades\Route;
use App\Models\Customer;
use App\Models\Contract;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ServiceController;

Route::get('/', function () {
    return view('welcome');
});

Route::delete('/customer/{id}', [CustomerController::class, 'destroy']);

Route::get('/services', [ServiceController::class, 'index']);
Route::get('/services/{service}', [ServiceController::class, 'show']);

Route::get('/contracts/create', [ContractController::class, 'create']);
Route::get('/contracts', [ContractController::class, 'index']);
Route::get('/contracts/{contract}', [ContractController::class, 'show']);
Route::post('/contracts', [ContractController::class, 'store']);

Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/customers/{customer}', [CustomerController::class, 'show']);
Route::post('/customers', [CustomerController::class, 'create']);
Route::patch('/customers/{customer}', [CustomerController::class, 'update']);

?>
