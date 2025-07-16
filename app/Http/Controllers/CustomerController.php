<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('customer-management', compact('customers'));
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer-name' => ['required', 'unique:customers,name'],
            'customer-DARBI-number' => ['required', 'numeric'],
        ]);
        if ($validator->fails()) {
            // @TODO
        }
        try {
            Customer::create([
                'name' => request('name'),
                'darbi_account' => request('customer-DARBI-number'),
                'darbi_site' => request('darbi_site'),
                'correspondence' => request('correspondence'),
                'notes' => request('notes'),
            ]);
            $customers = Customer::all();
            return view('customers.index', compact('customers'))->fragment('customer-list');
        } catch (\Exception $error) {
            dd($error); // @TODO implement
        }
    }

    public function destroy($id)
    {
        $targetCustomer = Customer::find($id);
        $targetCustomer->delete();
        $customers = Customer::all();
        return view('customers.index', compact('customers'))->fragment('customer-list');
    }
}
