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
        // @TODO if mode is edit, don't return a view
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'unique:customers,name'],
            'darbi_customer_account_number' => ['required', 'numeric'],
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
                'darbi_customer_account_number' => request('darbi_customer_account_number'),
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
            'darbi_customer_account_number' => ['required', 'numeric', 'digits:4'],
            'darbi_site' => ['required'], // @TODO letter followed by four numbers
            'correspondence' => ['required'],
        ]);

        // Update
        $customer->update([
            'name' => request('name'),
            'darbi_customer_account_number' => request('darbi_customer_account_number'),
            'darbi_site' => request('darbi_site'),
            'correspondence' => request('correspondence'),
            'notes' => request('notes')
        ]);

        // Redirect to the customer page
        // return redirect('/customers/' . $customer->id);
        $customers = Customer::all();
        $viewHtml = view('customers.show', compact('customers'))->fragment('customer-list');
        return response($viewHtml)
            ->header('HX-Trigger', json_encode([
                'toast' => 'Customer successfully updated!',
                'close-form' => true
            ]));
    }

    public function destroy($id) {
        $targetCustomer = Customer::find($id);
        $targetCustomer->delete();
        $customers = Customer::all();
        return view('customers.index', compact('customers'))->fragment('customer-list');
    }
}
