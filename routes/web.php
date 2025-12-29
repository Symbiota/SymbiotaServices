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

Route::get('/register', [RegisteredUserController::class, 'create'])->name('user.create');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('user.store');

Route::get('/login', [SessionController::class, 'create'])->name('session.create');
Route::post('/login', [SessionController::class, 'store'])->name('session.store');
Route::post('/logout', [SessionController::class, 'destroy'])->name('session.destroy');

Route::middleware(['auth'])->group(function () {
    Route::get('/user', [RegisteredUserController::class, 'show'])->name('user.show');
    Route::patch('/user/update', [RegisteredUserController::class, 'update'])->name('user.update');
    Route::patch('/user/changePassword', [RegisteredUserController::class, 'changePassword'])->name('user.changePassword');

    Route::controller(ServiceController::class)->group(function () {
        Route::get('/services', 'index')->name('services.index');
        Route::get('/services/create', 'create')->name('services.create');
        Route::get('/services/{service}', 'show')->name('services.show');
        Route::patch('/services/{service}/update', 'update')->name('services.update');
        Route::post('/services/store', 'store')->name('services.store');
        Route::patch('/services/{service}/retire', 'retire')->name('services.retire');
    });

    Route::controller(ContractController::class)->group(function () {
        Route::get('/contracts/create/{customer?}', 'create')->name('contracts.create');
        Route::get('/contracts', 'index')->name('contracts.index');
        Route::get('/contracts/{contract}', 'show')->name('contracts.show');
        Route::get('/contracts/{contract}/edit', 'edit')->name('contracts.edit');
        Route::post('/contracts/store', 'store')->name('contracts.store');
        Route::delete('/contracts/{contract}/delete', 'destroy')->name('contracts.destroy');
        Route::patch('/contracts/{contract}/update', 'update')->name('contracts.update');
    });

    Route::controller(CustomerController::class)->group(function () {
        Route::patch('/customers/{customer}/update', 'update')->name('customers.update');
        Route::get('/customers/create', 'create')->name('customers.create');
        Route::get('/customers/search', 'search')->name('customers.search');
        Route::delete('/customers/{customer}/delete', 'destroy')->name('customers.delete');
        Route::get('/customers/{customer}/edit', 'edit')->name('customers.edit');
        Route::get('/customers', 'index')->name('customers.index');
        Route::post('/customers/store', 'store')->name('customers.store');
        Route::get('/customers/{customer}', 'show')->name('customers.show');
        Route::get('/customers/{customer}/exportCSV/{contract?}', 'exportCSV')->name('customers.exportCSV');
    });

    Route::controller(InvoiceController::class)->group(function () {
        Route::get('/invoices/create/{contract?}/{invoice?}', 'create')->name('invoices.create');
        Route::get('/invoices', 'index')->name('invoices.index');
        Route::get('/invoices/{invoice}', 'show')->name('invoices.show');
        Route::get('/invoices/{invoice}/edit', 'edit')->name('invoices.edit');
        Route::get('/invoices/{invoice}/exportCSV', 'exportCSV')->name('invoices.exportCSV');
        Route::post('/invoices/store', 'store')->name('invoices.store');
        Route::patch('/invoices/{invoice}/update', 'update')->name('invoices.update');
    });

    Route::controller(ContactController::class)->group(function () {
        Route::get('/contacts', 'index')->name('contacts.index');
        Route::get('/contacts/create', 'create')->name('contacts.create');
        Route::get('/contacts/search', 'search')->name('contacts.search');
        Route::get('/contacts/{contact}', 'show')->name('contacts.show');
        Route::patch('/contacts/{contact}/update', 'update')->name('contacts.update');
        Route::post('/contacts/store', 'store')->name('contacts.store');
    });
});
