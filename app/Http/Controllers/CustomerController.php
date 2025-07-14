<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index() {
        return view('customers.index', ['customers' => Customer::all()]);
    }

    public function show(Customer $customer) {
        return view('customers.show', compact('customer'));
    }

    public function create() {
        request()->validate([
            'name' => ['required', 'unique:customers,name'],
            'darbi_account' => ['required', 'numeric', 'digits:4'],
            'darbi_site' => ['required'],
            'correspondence' => ['required'],
        ]);

        Customer::create([
            'name' => request('name'),
            'darbi_account' => request('darbi_account'),
            'darbi_site' => request('darbi_site'),
            'correspondence' => request('correspondence'),
            'notes' => request('notes')
        ]);

        return redirect('/customers');
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
        $targetCustomer = Customer::find($id);
        $targetCustomer->delete();

        $customers = Customer::all();
        return view('customer-management', compact('customers'))
            ->fragment('customer-list');
    }

}
