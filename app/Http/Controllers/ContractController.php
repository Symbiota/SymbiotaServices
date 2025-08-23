<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Customer;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index() {
        return view('contracts.index', ['contracts' => Contract::all()]);
    }

    public function show(Contract $contract) {
        return view('contracts.show', ['contract' => $contract]);
    }

    public function create(Customer $customer) {
        return view('contracts.create', ['customer' => $customer]);
    }

    public function store() {
        request()->validate([
            'customer_id' => ['required', 'exists:customers,id'],
            'original_contact_id' => ['required', 'numeric', 'exists:contacts,id'],
            'darbi_header_ref_1' => ['required'],
        ]);

        $contract = Contract::create([
            'customer_id' => request('customer_id'),
            'original_contact_id' => request('original_contact_id'),
            'darbi_header_ref_1' => request('darbi_header_ref_1'),
            'darbi_header_ref_2' => request('darbi_header_ref_2'),
            'darbi_special_instructions' => request('darbi_special_instructions'),
            'notes' => request('notes'),
        ]);

        return redirect('/customers/' . $contract->customer_id);
    }

    public function update(Contract $contract) {
        request()->validate([
            'customer_id' => ['required'],
            'original_contact_id' => ['required'],
            'darbi_header_ref_1' => ['required'],
        ]);

        $contract->update([
            'customer_id' => request('customer_id'),
            'original_contact_id' => request('original_contact_id'),
            'darbi_header_ref_1' => request('darbi_header_ref_1'),
            'darbi_header_ref_2' => request('darbi_header_ref_2'),
            'darbi_special_instructions' => request('darbi_special_instructions'),
            'notes' => request('notes'),
        ]);

        return redirect('/contracts/' . $contract->id);
    }

    public function destroy(Contract $contract)
    {
        $contract->delete();
        return redirect('/contracts/');
    }

}
