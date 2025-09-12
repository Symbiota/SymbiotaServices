<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customers.index', ['customers' => Customer::all()]);
    }

    public function show(Customer $customer)
    {
        return view('customers.show', ['customer' => $customer]);
    }

    public function create(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => ['required', 'unique:customers,name'],
                'darbi_customer_account_number' => ['required', 'numeric', 'digits:4'],
                'darbi_site' => ['required', 'regex:/^[a-zA-Z][0-9]{4}$/'],
                'address_line_1' => ['required'],
                'city' => ['required'],
                'state' => ['required'],
                'zip_code' => ['required'],
                'country' => ['required'],
            ]);
            if ($validated) {
                Customer::create([
                    'name' => request('name'),
                    'darbi_customer_account_number' => request('darbi_customer_account_number'),
                    'darbi_site' => request('darbi_site'),
                    'correspondence' => request('correspondence'),
                    'department_name' => request('department_name'),
                    'address_line_1' => request('address_line_1'),
                    'address_line_2' => request('address_line_2'),
                    'city' => request('city'),
                    'state' => request('state'),
                    'zip_code' => request('zip_code'),
                    'country' => request('country'),
                    'notes' => request('notes'),
                ]);
                $customers = Customer::all();
                $viewHtml = view('customers.index', compact('customers'))->fragment('customer-list');
                return response($viewHtml)->header(
                    'HX-Trigger',
                    json_encode([
                        'toast' => 'Customer successfully created!',
                        'close-form' => true,
                        'create-success' => true,
                    ]),
                );
            }
        } catch (ValidationException $e) {
            $customers = Customer::all();
            return view('customers.index', compact('customers'))->withErrors($e->errors())->fragment('customer-list');
        }
    }

    public function update(Customer $customer)
    {
        request()->validate([
            'name' => ['required'],
            'darbi_customer_account_number' => ['required', 'numeric', 'digits:4'],
            'darbi_site' => ['required', 'regex:/^[a-zA-Z][0-9]{4}$/'],
            'address_line_1' => ['required'],
            'city' => ['required'],
            'state' => ['required'],
            'zip_code' => ['required'],
            'country' => ['required'],
        ]);

        $customer->update([
            'name' => request('name'),
            'darbi_customer_account_number' => request('darbi_customer_account_number'),
            'darbi_site' => request('darbi_site'),
            'correspondence' => request('correspondence'),
            'department_name' => request('department_name'),
            'address_line_1' => request('address_line_1'),
            'address_line_2' => request('address_line_2'),
            'city' => request('city'),
            'state' => request('state'),
            'zip_code' => request('zip_code'),
            'country' => request('country'),
            'notes' => request('notes'),
        ]);

        $viewHtml = view('customers.show', compact('customer'))->fragment('customer-list');
        return response($viewHtml)->header(
            'HX-Trigger',
            json_encode([
                'toast' => 'Customer successfully updated!',
                'close-form' => true,
            ]),
        );
    }

    public function destroy($id)
    {
        $targetCustomer = Customer::find($id);
        $targetCustomer->delete();
        $customers = Customer::all();
        return view('customers.index', compact('customers'))->fragment('customer-list');
    }
}
