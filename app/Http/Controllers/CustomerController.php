<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller {
    public function index() {
        return view('customers.index', ['customers' => Customer::all()]); // Passes array $customers to index view
    }

    public function show(Customer $customer) { // Customer $customer automatically retrieves the ID of the customer
        return view('customers.show', ['customer' => $customer]); // Passes that customer to a new variable $customer for the show view
    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'customer-name' => ['required', 'unique:customers,name'],
            'customer-DARBI-number' => ['required', 'numeric'],
        ]);
        // request()->validate([
        //     'customer-name' => ['required', 'unique:customers,name'],
        //     'customer-DARBI-number' => ['required', 'numeric']
        // ]);
        // $validator = request()->validate([
        //     'customer-name' => ['required', 'unique:customers,name'],
        //     'customer-DARBI-number' => ['required', 'numeric']
        // ]);
        if ($validator->fails()) {
            // dd($validator);
            // $viewHtml = view('customers.index', compact('customers'))->fragment('error-div');
            // return response($viewHtml);
            // return response(
            //     view('customers.index', [
            //         'customers' => Customer::all()
            //     ])->withErrors($validator)
            //         ->fragment('error-div')
            // )->setStatusCode(422);
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
            $viewHtml = view('customers.index', compact('customers'))->fragment('customer-list');
            return response($viewHtml)
                ->header('HX-Trigger', json_encode([
                    'toast' => 'Customer successfully created!',
                    'close-form' => true
                ]));
        } catch (\Exception $error) {
            dd($error); // @TODO implement
        }
    }


    public function update(Customer $customer) {
        // Validate
        request()->validate([
            'name' => ['required'],
            'darbi_account' => ['required', 'numeric', 'digits:4'],
            'darbi_site' => ['required'],
            'correspondence' => ['required'],
        ]);

        // Update
        $customer->update([
            'name' => request('name'),
            'darbi_account' => request('darbi_account'),
            'darbi_site' => request('darbi_site'),
            'correspondence' => request('correspondence'),
            'notes' => request('notes')
        ]);

        // Redirect to the customer page
        return redirect('/customers/' . $customer->id);
    }

    public function destroy($id) {
        sleep(10);
        $targetCustomer = Customer::find($id);
        $targetCustomer->delete();
        $customers = Customer::all();
        return view('customers.index', compact('customers'))->fragment('customer-list');
    }
}
