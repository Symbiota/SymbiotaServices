<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Models\Contract;
use App\Models\Service;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contracts', function (){
    return view('contracts', ['contracts' => Contract::all()]);
});

Route::get('/contracts/{id}', function ($id){
    $contract = Contract::find($id);
    return view('contract', compact('contract'));
});

Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/customers/{customer}', [CustomerController::class, 'show']);
Route::post('/customers', [CustomerController::class, 'create']);
Route::patch('/customers/{customer}', [CustomerController::class, 'update']);




?>