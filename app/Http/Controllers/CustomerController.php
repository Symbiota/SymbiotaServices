<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
                'darbi_customer_account_number' => ['required', 'numeric']
            ]);
            if($validated){
                Customer::create([
                    'name' => request('name'),
                    'darbi_customer_account_number' => request('darbi_customer_account_number'),
                    'darbi_site' => request('darbi_site'),
                    'correspondence' => request('correspondence'),
                    'notes' => request('notes'),
                ]);
                $customers = Customer::all();
                $viewHtml = view('customers.index', compact('customers'))->fragment('customer-list');
                return response($viewHtml)->header(
                    'HX-Trigger',
                    json_encode([
                        'toast' => 'Customer successfully created!',
                        'close-form' => true,
                    ]),
                );
            }   
        } catch (ValidationException $e) {
            // dd($e->errors());
            // dd(collect($e->errors()));
            $customers = Customer::all();
            return view('customers.index', compact('customers'))
                ->withErrors($e->errors())
                ->fragment('customer-list');
        }
        // $validator = Validator::make($request->all(), [
        //     'name' => ['required', 'unique:customers,name'],
        //     'darbi_customer_account_number' => ['required', 'numeric'],
        // ]);
        // dd($validator);
        // request()->validate([
        //     'customer-name' => ['required', 'unique:customers,name'],
        //     'customer-DARBI-number' => ['required', 'numeric']
        // ]);
        // $validator = request()->validate([
        //     'customer-name' => ['required', 'unique:customers,name'],
        //     'customer-DARBI-number' => ['required', 'numeric']
        // ]);
        // if ($validator->fails()) {
        //     // dd($validator);
        //     // $viewHtml = view('customers.index', compact('customers'))->fragment('error-div');
        //     // return response($viewHtml);
        //     return response()
        //         ->view('customers.index', [
        //             'errors' => $validator->errors(),
        //         ])
        //         ->fragment('error-div');
        //     // return response(
        //     //     view('customers.index', [
        //     //         'customers' => Customer::all()
        //     //     ])->withErrors($validator)
        //     //         ->fragment('error-div')
        //     // )->setStatusCode(422);
        // }
        // try {
        //     Customer::create([
        //         'name' => request('name'),
        //         'darbi_customer_account_number' => request('darbi_customer_account_number'),
        //         'darbi_site' => request('darbi_site'),
        //         'correspondence' => request('correspondence'),
        //         'notes' => request('notes'),
        //     ]);
        //     $customers = Customer::all();
        //     $viewHtml = view('customers.index', compact('customers'))->fragment('customer-list');
        //     return response($viewHtml)->header(
        //         'HX-Trigger',
        //         json_encode([
        //             'toast' => 'Customer successfully created!',
        //             'close-form' => true,
        //         ]),
        //     );
        // } catch (\Exception $error) {
        //     dd($error); // @TODO implement
        // }
    }

    public function update(Customer $customer)
    {
        request()->validate([
            'name' => ['required'],
            'darbi_customer_account_number' => ['required', 'numeric', 'digits:4'],
            'darbi_site' => ['required'], // @TODO letter followed by four numbers
            'correspondence' => ['required'],
        ]);

        $customer->update([
            'name' => request('name'),
            'darbi_customer_account_number' => request('darbi_customer_account_number'),
            'darbi_site' => request('darbi_site'),
            'correspondence' => request('correspondence'),
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
