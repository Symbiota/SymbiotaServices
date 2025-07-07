<?php

use Illuminate\Support\Facades\Route;
use App\Models\Customer;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/customer-management', function () {
    $customers = Customer::all();
    return view('customer-management', compact('customers'));
});

Route::post('/customer', function(){
    request()->validate([
        'customer-name'=>['required', 'unique:customers,name'],
        'customer-DARBI-number'=>['required', 'numeric']
    ]);
    Customer::create([
        'name'=>request('customer-name'),
        'darbi_account'=>request('customer-DARBI-number')
    ]);
    return redirect('/customer-management');
});

Route::delete('/customer/{id}', function($id){
    $targetCustomer = Customer::find($id);
    $targetCustomer->delete();

    $customers = Customer::all();
    return view('customer-management', compact('customers'))
        ->fragment('customer-list');

    // return redirect('/customer-management');
});

?>