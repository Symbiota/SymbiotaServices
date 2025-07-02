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
    Customer::create([
        'name'=>request('customer-name'),
        'darbi_account'=>request('customer-DARBI-number')
    ]);

    // @TODO return what? a redirect?
    // dd(request()->all());
})

?>