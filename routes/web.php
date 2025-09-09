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

Route::get('/services', [ServiceController::class, 'index'])->name('services.index')->middleware('auth');
Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show')->middleware('auth');
Route::patch('/services/{service}/update', [ServiceController::class, 'update'])->name('services.update')->middleware('auth');
Route::post('/services/store', [ServiceController::class, 'store'])->name('services.store')->middleware('auth');
Route::patch('/services/{service}/retire', [ServiceController::class, 'retire'])->name('services.retire')->middleware('auth');

Route::get('/contracts/create/{customer?}', [ContractController::class, 'create'])->name('contracts.create')->middleware('auth');
Route::get('/contracts', [ContractController::class, 'index'])->name('contracts.index')->middleware('auth');
Route::get('/contracts/{contract}', [ContractController::class, 'show'])->name('contracts.show')->middleware('auth');
Route::post('/contracts/store', [ContractController::class, 'store'])->name('contracts.store')->middleware('auth');
Route::delete('/contracts/{contract}/delete', [ContractController::class, 'destroy'])->name('contracts.destroy')->middleware('auth');
Route::patch('/contracts/{contract}/update', [ContractController::class, 'update'])->name('contracts.update')->middleware('auth');

Route::get('/customers', [CustomerController::class, 'index'])->middleware('auth');
Route::get('/customers/{customer}', [CustomerController::class, 'show'])->middleware('auth');
Route::post('/customers', [CustomerController::class, 'create'])->middleware('auth');
Route::patch('/customers/{customer}', [CustomerController::class, 'update'])->middleware('auth');

Route::get('/invoices/create/{contract?}', [InvoiceController::class, 'create'])->name('invoices.create')->middleware('auth');
Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index')->middleware('auth');
Route::get('/invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show')->middleware('auth');
Route::get('/invoices/{invoice}/exportCSV', [InvoiceController::class, 'exportCSV'])->name('invoices.exportCSV')->middleware('auth');
Route::post('/invoices/store', [InvoiceController::class, 'store'])->name('invoices.store')->middleware('auth');
Route::patch('/invoices/{invoice}/update', [InvoiceController::class, 'update'])->name('invoices.update')->middleware('auth');

Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index')->middleware('auth');
Route::get('/contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show')->middleware('auth');
Route::patch('/contacts/{contact}/update', [ContactController::class, 'update'])->name('contacts.update')->middleware('auth');
Route::post('/contacts/store', [ContactController::class, 'store'])->name('contacts.store')->middleware('auth');

Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);
