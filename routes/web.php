<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/customer-management', [CustomerController::class, 'index']);
Route::post('/customer', [CustomerController::class, 'create']);
Route::delete('/customer/{id}', [CustomerController::class, 'destroy']);
?>