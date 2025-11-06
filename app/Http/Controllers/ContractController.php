<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Customer;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index()
    {
        return view('contracts.index', ['contracts' => Contract::all()]);
    }

    public function show(Contract $contract)
    {
        return view('contracts.show', [
            'contract' => $contract,
            'contacts' => Contact::all()->sortBy('last_name'),
            'customers' => Customer::all()->sortBy('name'),
        ]);
    }

    public function create(Customer $customer)
    {
        return view('contracts.create', [
            'customer' => $customer,
            'contacts' => Contact::all()->sortBy('last_name'),
            'customers' => Customer::all()->sortBy('name'),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => ['required', 'exists:customers,name'],
            'financial_contact_id' => ['required', 'numeric:strict', 'exists:contacts,id'],
            'pi_contact_id' => ['nullable', 'numeric:strict', 'exists:contacts,id'],
            'technical_contact_id' => ['nullable', 'numeric:strict', 'exists:contacts,id'],
            'darbi_header_ref_1' => ['required'],
            'darbi_header_ref_2' => ['nullable'],
            'darbi_special_instructions' => ['nullable'],
            'notes' => ['nullable'],
        ]);

        $data += ['original_contact_id' => $data['financial_contact_id'], 'current_financial_contact_id' => $data['financial_contact_id']];
        unset($data['financial_contact_id']);

        $customer = Customer::where('name', $data['customer_id'])->firstOrFail();
        $data['customer_id'] = $customer->id;

        $contract = Contract::create($data);

        return redirect()->route('contracts.show', $contract);
    }

    public function update(Request $request, Contract $contract)
    {
        $data = $request->validate([
            'customer_id' => ['required', 'exists:customers,name'],
            'financial_contact_id' => ['required', 'numeric:strict', 'exists:contacts,id'],
            'pi_contact_id' => ['nullable', 'numeric:strict', 'exists:contacts,id'],
            'technical_contact_id' => ['nullable', 'numeric:strict', 'exists:contacts,id'],
            'darbi_header_ref_1' => ['required'],
            'darbi_header_ref_2' => ['nullable'],
            'darbi_special_instructions' => ['nullable'],
            'notes' => ['nullable'],
        ]);
        
        $data += ['current_financial_contact_id' => $data['financial_contact_id']];
        unset($data['financial_contact_id']);

        $customer = Customer::where('name', $data['customer_id'])->firstOrFail();
        $data['customer_id'] = $customer->id;
        
        $contract->update($data);

        return redirect()->route('contracts.show', $contract);
    }

    public function destroy(Contract $contract)
    {
        $contract->delete();
        return redirect()->route('contracts.index');
    }
}
