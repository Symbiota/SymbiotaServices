<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customer::all();
        return view('customer-management', compact('customers'));
    }

    public function create(){
        request()->validate([
            'customer-name'=>['required', 'unique:customers,name'],
            'customer-DARBI-number'=>['required', 'numeric']
        ]);
        Customer::create([
            'name'=>request('customer-name'),
            'darbi_account'=>request('customer-DARBI-number')
        ]);
        return redirect('/customer-management');
    }

    public function destroy($id){
        $targetCustomer = Customer::find($id);
        $targetCustomer->delete();

        $customers = Customer::all();
        return view('customer-management', compact('customers'))
            ->fragment('customer-list');
    }

}
