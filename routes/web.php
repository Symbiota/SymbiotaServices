<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/customer-management', function () {
    return view('customer-management');
});

Route::post('/customer', function(){
    // Customer::create([

    // ])
    dd(request()->all());
})

?>