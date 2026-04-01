<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('name')->get();
        return view('customers.index', [
            'customers' => $customers,
            'allCustomersList' => $customers
        ])->fragmentIf(request()->hasHeader('HX-Request'), 'customer-list');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        return view('customers.index', [
            'customers' => Customer::where('name', 'like', "%$search%")->orderBy('name')->get(),
            'allCustomersList' => Customer::orderBy('name')->get()
        ])->fragmentIf(request()->hasHeader('HX-Request'), 'customer-list');
    }

    public function show(Customer $customer)
    {
        return view('customers.show', ['customer' => $customer]);
    }

    public function create(Request $request)
    {
        return view('customers.create');
    }

    public function edit(Request $request, Customer $customer)
    {
        $isHTMX = $request->hasHeader('HX-Request');

        return view('customers.edit', [
            'isHTMX' => $isHTMX,
            'customer' => $customer,
        ])->fragmentIf($isHTMX, 'edit-customer');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'unique:customers,name'],
            'department_name' => ['nullable'],
            'darbi_customer_account_number' => ['nullable'],
            'darbi_site' => ['nullable'],
            'address_line_1' => ['required'],
            'address_line_2' => ['nullable'],
            'city' => ['required'],
            'state' => ['required'],
            'zip_code' => ['required'],
            'country' => ['required'],
            'notes' => ['nullable'],
        ]);

        $customer = Customer::create($data);

        return redirect()->route('customers.show', $customer);
    }

    public function update(Request $request, Customer $customer)
    {
        $isHTMX = $request->hasHeader('HX-Request');
        try {
            $data = $request->validate([
                'name' => ['required', \Illuminate\Validation\Rule::unique('customers')->ignore($customer->id)],
                'department_name' => ['nullable'],
                'darbi_customer_account_number' => ['nullable'],
                'darbi_site' => ['nullable'],
                'address_line_1' => ['required'],
                'address_line_2' => ['nullable'],
                'city' => ['required'],
                'state' => ['required'],
                'zip_code' => ['required'],
                'country' => ['required'],
                'notes' => ['nullable'],
            ]);

            $customer->update($data);

            if ($isHTMX) {
                return response(null, 204)->header('HX-Redirect', route('customers.show', $customer));
            }
            return redirect()->route('customers.show', $customer);
        } catch (ValidationException $e) {
            if ($isHTMX) {
                return view('customers.edit', [
                    'isHTMX' => $isHTMX,
                    'customer' => $customer,
                ])->withErrors($e->errors())->fragment('edit-customer');
            }
            throw $e;
        }
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        $customers = Customer::all();
        return view('customers.index', [
            'customers' => $customers,
            'allCustomersList' => $customers
        ])->fragmentIf(request()->hasHeader('HX-Request'), 'customer-list');
    }

    public function exportCSV(Customer $customer, Contract $contract)
    {
        $customer_name = preg_replace('/\s+/', '', $customer->name);
        $filename = 'CustomerRequest_' . $customer_name . '_' . date('Y-m-d') . '.csv';

        $sanitizedFilename = preg_replace('/[^a-zA-Z0-9_\-\.]/', '_', $filename);
        $handle = fopen($sanitizedFilename, 'w'); // @TODO laravelize this?

        $headers = [
            ['Submitted  by (Required)',],
            [
                'NAME',
                'EMAIL',
                'PHONE',
                'REQUEST DATE',
            ],
            [
                auth()->user()->name, // Works, inputs user name
                auth()->user()->email,
                '',
                date('m/d/Y'), // Current date
            ],
            [],
            [],
            [
                'Requested Action',
                'Customer Name - Department/PI/External Customer',
                'Department Name - Department/Division/Store Number',
                'Address Line 1 - Street Address',
                'Address Line 2 - Building, Suite, Room',
                'City',
                'State',
                'Postal Code',
                'Country',
                'Bill To Contact First Name',
                'Bill To Contact Last Name',
                'Bill To Contact Email Address',
                'Does customer require additional attachments? (Create Site with single contact)',
                'NOTES:',
            ],
        ];

        foreach ($headers as $submit) {
            fputcsv($handle, $submit);
        }

        $data = [
            'NEW CUSTOMER',
            '1 - ' . $customer->name,
            $customer->department_name,
            $customer->address_line_1,
            $customer->address_line_2,
            $customer->city,
            $customer->state,
            $customer->zip_code,
            $customer->country,
            $contract->current_financial_contact->first_name ?? '',
            $contract->current_financial_contact->last_name ?? '',
            $contract->current_financial_contact->email ?? '',
            'NO',
            $customer->notes,
        ];

        fputcsv($handle, $data);

        fclose($handle);

        return response()->download(public_path($sanitizedFilename))->deleteFileAfterSend(true);
    }
}
