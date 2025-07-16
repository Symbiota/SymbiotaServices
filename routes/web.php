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
Route::get('/customer-management', [CustomerController::class, 'index']);
Route::post('/customer', [CustomerController::class, 'create']);
Route::delete('/customer/{id}', [CustomerController::class, 'destroy']);

Route::get('/contracts', function () {
    return view('contracts', ['contracts' => Contract::all()]);
});

Route::get('/contracts/{id}', function ($id) {
    $contract = Contract::find($id);
    return view('contract', compact('contract'));
});

Route::get('/customers', function () {
    return view('customers.index', ['customers' => Customer::all()]);
});

Route::get('/customers/{id}', function ($id) {
    $customer = Customer::find($id);
    return view('customers.show', compact('customer')); // = ['customer' => $customer]
});

Route::get('/customers/{id}/edit', function ($id) {
    $customer = Customer::find($id);
    return view('customers.edit', ['customer' => $customer]);
});

// Update
Route::patch('/customers/{id}', function ($id) {
    // Validate
    request()->validate([
        'name' => ['required'],
        'darbi_account' => ['required', 'numeric', 'digits:4'],
        'darbi_site' => ['required'],
        'correspondence' => ['required'],
    ]);
    // Authorize

    // Update
    $customer = Customer::findOrFail($id);
    $customer->update([
        'name' => request('name'),
        'darbi_account' => request('darbi_account'),
        'darbi_site' => request('darbi_site'),
        'correspondence' => request('correspondence'),
        'notes' => request('notes'),
    ]);

    // and Persist

    // redirect to the customer page
    return redirect('/customers/' . $customer->id);
});

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
