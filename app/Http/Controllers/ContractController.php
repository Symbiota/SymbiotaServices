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
            'contacts' => Contact::all(),
        ]);
    }

    public function create(Customer $customer)
    {
        return view('contracts.create', [
            'customer' => $customer,
            'contacts' => Contact::all(),
        ]);
    }

    public function store()
    {
        request()->validate([
            'customer_id' => ['required', 'exists:customers,id'],
            'financial_contact_id' => ['required', 'numeric', 'exists:contacts,id'],
            'darbi_header_ref_1' => ['required'],
            'pi_contact_id' => ['nullable', 'numeric', 'exists:contacts,id'],
            'technical_contact_id' => ['nullable', 'numeric', 'exists:contacts,id'],
        ]);

        $contract = Contract::create([
            'customer_id' => request('customer_id'),
            'original_contact_id' => request('financial_contact_id'),
            'current_financial_contact_id' => request('financial_contact_id'),
            'pi_contact_id' => request('pi_contact_id'),
            'technical_contact_id' => request('technical_contact_id'),
            'darbi_header_ref_1' => request('darbi_header_ref_1'),
            'darbi_header_ref_2' => request('darbi_header_ref_2'),
            'darbi_special_instructions' => request('darbi_special_instructions'),
            'notes' => request('notes'),
        ]);

        return redirect('/contracts/' . $contract->id);
    }

    public function update(Contract $contract)
    {
        request()->validate([
            'customer_id' => ['required', 'exists:customers,id'],
            'financial_contact_id' => ['required', 'numeric', 'exists:contacts,id'],
            'darbi_header_ref_1' => ['required'],
            'pi_contact_id' => ['nullable', 'numeric', 'exists:contacts,id'],
            'technical_contact_id' => ['nullable', 'numeric', 'exists:contacts,id'],
        ]);

        $contract->update([
            'customer_id' => request('customer_id'),
            'current_financial_contact_id' => request('financial_contact_id'),
            'pi_contact_id' => request('pi_contact_id'),
            'technical_contact_id' => request('technical_contact_id'),
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
