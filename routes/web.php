<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/customer', [CustomerController::class, 'create'])->middleware('auth');
Route::delete('/customer/{id}', [CustomerController::class, 'destroy'])->middleware('auth');

Route::get('/services', [ServiceController::class, 'index'])->middleware('auth');
Route::get('/services/{service}', [ServiceController::class, 'show'])->middleware('auth');
Route::patch('/services/{service}', [ServiceController::class, 'update'])->middleware('auth');
Route::post('/services', [ServiceController::class, 'store'])->middleware('auth');
Route::patch('/services/{service}/retire', [ServiceController::class, 'retire'])->middleware('auth');


Route::get('/contracts/create/{customer?}', [ContractController::class, 'create'])->name('contracts.create')->middleware('auth');
Route::get('/contracts', [ContractController::class, 'index'])->middleware('auth');
Route::get('/contracts/{contract}', [ContractController::class, 'show'])->middleware('auth');
Route::post('/contracts', [ContractController::class, 'store'])->middleware('auth');
Route::delete('/contracts/{contract}', [ContractController::class, 'destroy'])->middleware('auth');
Route::patch('/contracts/{contract}', [ContractController::class, 'update'])->middleware('auth');

Route::get('/customers', [CustomerController::class, 'index'])->middleware('auth');
Route::get('/customers/{customer}', [CustomerController::class, 'show'])->middleware('auth');
Route::post('/customers', [CustomerController::class, 'create'])->middleware('auth');
Route::patch('/customers/{customer}', [CustomerController::class, 'update'])->middleware('auth');

Route::get('/invoices/create/{contract?}', [InvoiceController::class, 'create'])->name('invoices.create')->middleware('auth');
Route::get('/invoices', [InvoiceController::class, 'index'])->middleware('auth');
Route::get('/invoices/{invoice}', [InvoiceController::class, 'show'])->middleware('auth');
Route::get('/invoices/{invoice}/exportCSV', [InvoiceController::class, 'exportCSV'])->middleware('auth');
Route::post('/invoices', [InvoiceController::class, 'store'])->middleware('auth');
Route::patch('/invoices/{invoice}', [InvoiceController::class, 'update'])->middleware('auth');

Route::get('/contacts', [ContactController::class, 'index'])->middleware('auth');
Route::get('/contacts/{contact}', [ContactController::class, 'show'])->middleware('auth');
Route::patch('/contacts/{contact}', [ContactController::class, 'update'])->middleware('auth');
Route::post('/contacts/create', [ContactController::class, 'store'])->middleware('auth');

Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);
