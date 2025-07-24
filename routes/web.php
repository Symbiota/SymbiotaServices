<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ServiceController;
use App\Models\Contact;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/customer', [CustomerController::class, 'create']);
Route::delete('/customer/{id}', [CustomerController::class, 'destroy']);

Route::get('/services', [ServiceController::class, 'index']);
Route::get('/services/{service}', [ServiceController::class, 'show']);

Route::get('/contracts/create/{customer?}', [ContractController::class, 'create'])->name('contracts.create');
Route::get('/contracts', [ContractController::class, 'index']);
Route::get('/contracts/{contract}', [ContractController::class, 'show']);
Route::post('/contracts', [ContractController::class, 'store']);
Route::patch('/contracts/{contract}', [ContractController::class, 'update']);

Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/customers/{customer}', [CustomerController::class, 'show']);
Route::post('/customers', [CustomerController::class, 'create']);
Route::patch('/customers/{customer}', [CustomerController::class, 'update']);

Route::get('/contacts', function (){
    return view('contacts.index', ['contacts' => Contact::all()]);
});

?>
