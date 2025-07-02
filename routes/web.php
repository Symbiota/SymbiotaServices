<?php

use Illuminate\Support\Facades\Route;
use App\Models\Customer;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/customer-management', function () {
    return view('customer-management');
});

Route::post('/customer', function(){
    //@TODO validate
    request()->validate([
        'customer-name'=>['required'],
        'customer-DARBI-number'=>['required']

    ]);
    Customer::create([
        'name'=>request('customer-name'),
        'darbi_account'=>request('customer-DARBI-number')
    ]);
    return redirect('/customer-management');
})

?>