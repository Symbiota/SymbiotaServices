<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Models\Contact;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/customer', [CustomerController::class, 'create'])->middleware('auth');
Route::delete('/customer/{id}', [CustomerController::class, 'destroy'])->middleware('auth');

Route::get('/services', [ServiceController::class, 'index'])->middleware('auth');
Route::get('/services/{service}', [ServiceController::class, 'show'])->middleware('auth');
Route::patch('/services/{service}', [ServiceController::class, 'update'])->middleware('auth');
Route::post('/services', [ServiceController::class, 'store'])->middleware('auth');
Route::patch('/services/{service}/retire', [ServiceController::class, 'retire']);

Route::get('/contracts/create/{customer?}', [ContractController::class, 'create'])->name('contracts.create')->middleware('auth');
Route::get('/contracts', [ContractController::class, 'index'])->middleware('auth');
Route::get('/contracts/{contract}', [ContractController::class, 'show'])->middleware('auth');
Route::post('/contracts', [ContractController::class, 'store'])->middleware('auth');
Route::patch('/contracts/{contract}', [ContractController::class, 'update'])->middleware('auth');

Route::get('/customers', [CustomerController::class, 'index'])->middleware('auth');
Route::get('/customers/{customer}', [CustomerController::class, 'show'])->middleware('auth');
Route::post('/customers', [CustomerController::class, 'create'])->middleware('auth');
Route::patch('/customers/{customer}', [CustomerController::class, 'update'])->middleware('auth');

Route::get('/contacts', function (){
    return view('contacts.index', ['contacts' => Contact::all()]);
})->middleware('auth');

Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

?>