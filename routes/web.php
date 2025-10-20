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
})->name('home');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

Route::get('/login', [SessionController::class, 'create'])->name('session.create');
Route::post('/login', [SessionController::class, 'store'])->name('session.store');
Route::post('/logout', [SessionController::class, 'destroy'])->name('session.destroy');

Route::middleware(['auth'])->group(function () {
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');
    Route::get('/services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::patch('/services/{service}/update', [ServiceController::class, 'update'])->name('services.update');
    Route::post('/services/store', [ServiceController::class, 'store'])->name('services.store');
    Route::patch('/services/{service}/retire', [ServiceController::class, 'retire'])->name('services.retire');

    Route::get('/contracts/create/{customer?}', [ContractController::class, 'create'])->name('contracts.create');
    Route::get('/contracts', [ContractController::class, 'index'])->name('contracts.index');
    Route::get('/contracts/{contract}', [ContractController::class, 'show'])->name('contracts.show');
    Route::post('/contracts/store', [ContractController::class, 'store'])->name('contracts.store');
    Route::delete('/contracts/{contract}/delete', [ContractController::class, 'destroy'])->name('contracts.destroy');
    Route::patch('/contracts/{contract}/update', [ContractController::class, 'update'])->name('contracts.update');

    Route::patch('/customers/{customer}/update', [CustomerController::class, 'update'])->name('customers.update');
    Route::post('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::delete('/customers/{customer}/delete', [CustomerController::class, 'destroy'])->name('customers.delete');
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/{customer}', [CustomerController::class, 'show'])->name('customers.show');
    Route::get('/customers/{customer}/exportCSV/{contract?}', [CustomerController::class, 'exportCSV'])->name('customers.exportCSV');

    Route::get('/invoices/create/{contract?}', [InvoiceController::class, 'create'])->name('invoices.create');
    Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('/invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');
    Route::get('/invoices/{invoice}/exportCSV', [InvoiceController::class, 'exportCSV'])->name('invoices.exportCSV');
    Route::post('/invoices/store', [InvoiceController::class, 'store'])->name('invoices.store');
    Route::patch('/invoices/{invoice}/update', [InvoiceController::class, 'update'])->name('invoices.update');

    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');
    Route::patch('/contacts/{contact}/update', [ContactController::class, 'update'])->name('contacts.update');
    Route::post('/contacts/store', [ContactController::class, 'store'])->name('contacts.store');
});
