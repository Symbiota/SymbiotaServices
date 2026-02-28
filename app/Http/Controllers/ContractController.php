<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Customer;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ContractController extends Controller
{
    public function index()
    {
        return view('contracts.index', ['contracts' => Contract::orderby('id', 'desc')->get()]);
    }

    public function show(Contract $contract)
    {
        return view('contracts.show', [
            'contract' => $contract,
        ]);
    }

    public function create(Customer $customer)
    {
        return view('contracts.create', [
            'customer' => $customer,
            'contacts' => Contact::orderBy('last_name')->get(),
            'customers' => Customer::orderBy('name')->get(),
        ]);
    }

    public function edit(Request $request, Contract $contract)
    {
        $isHTMX = $request->hasHeader('HX-Request');

        return view('contracts.edit', [
            'isHTMX' => $isHTMX,
            'contract' => $contract,
            'contacts' => Contact::orderBy('last_name')->get(),
            'customers' => Customer::orderBy('name')->get(),
        ])->fragmentIf($isHTMX, 'edit-contract');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => ['required', 'exists:customers,name'],
            'financial_contact_id' => ['required', 'exists:contacts,full_name'],
            'pi_contact_id' => ['nullable', 'exists:contacts,full_name'],
            'technical_contact_id' => ['nullable', 'exists:contacts,full_name'],
            'darbi_header_ref_1' => ['nullable', 'max:20'],
            'darbi_header_ref_2' => ['nullable', 'max:20'],
            'darbi_special_instructions' => ['nullable'],
            'notes' => ['nullable'],
        ]);

        $customer = Customer::where('name', $data['customer_id'])->firstOrFail();
        $data['customer_id'] = $customer->id;

        if ($data['pi_contact_id']) {
            $piContact = Contact::where('full_name', $data['pi_contact_id'])->firstOrFail();
            $data['pi_contact_id'] = $piContact->id;
        }

        if ($data['technical_contact_id']) {
            $technicalContact = Contact::where('full_name', $data['technical_contact_id'])->firstOrFail();
            $data['technical_contact_id'] = $technicalContact->id;
        }

        $financialContact = Contact::where('full_name', $data['financial_contact_id'])->firstOrFail();
        $data['financial_contact_id'] = $financialContact->id;

        $data += ['original_contact_id' => $data['financial_contact_id'], 'current_financial_contact_id' => $data['financial_contact_id']];
        unset($data['financial_contact_id']);

        $contract = Contract::create($data);

        return redirect()->route('contracts.show', $contract);
    }

    public function update(Request $request, Contract $contract)
    {
        $isHTMX = $request->hasHeader('HX-Request');

        try {
            $data = $request->validate([
                'customer_id' => ['required', 'exists:customers,name'],
                'financial_contact_id' => ['required', 'exists:contacts,full_name'],
                'pi_contact_id' => ['nullable', 'exists:contacts,full_name'],
                'technical_contact_id' => ['nullable', 'exists:contacts,full_name'],
                'darbi_header_ref_1' => ['nullable', 'max:20'],
                'darbi_header_ref_2' => ['nullable', 'max:20'],
                'darbi_special_instructions' => ['nullable'],
                'notes' => ['nullable'],
            ]);

            $customer = Customer::where('name', $data['customer_id'])->firstOrFail();
            $data['customer_id'] = $customer->id;

            if ($data['pi_contact_id']) {
                $piContact = Contact::where('full_name', $data['pi_contact_id'])->firstOrFail();
                $data['pi_contact_id'] = $piContact->id;
            }

            if ($data['technical_contact_id']) {
                $technicalContact = Contact::where('full_name', $data['technical_contact_id'])->firstOrFail();
                $data['technical_contact_id'] = $technicalContact->id;
            }

            $financialContact = Contact::where('full_name', $data['financial_contact_id'])->firstOrFail();
            $data['financial_contact_id'] = $financialContact->id;

            $data += ['current_financial_contact_id' => $data['financial_contact_id']];
            unset($data['financial_contact_id']);

            $contract->update($data);

            if ($isHTMX) {
                return response(null, 204)->header('HX-Redirect', route('contracts.show', $contract));
            }
            return redirect()->route('contracts.show', $contract);
        } catch (ValidationException $e) {

            if ($isHTMX) {
                return view('contracts.edit', [
                    'isHTMX' => $isHTMX,
                    'contract' => $contract,
                    'contacts' => Contact::orderBy('last_name')->get(),
                    'customers' => Customer::orderBy('name')->get(),
                ])->withErrors($e->errors())->fragment('edit-contract');
            }
            throw $e;
        }
    }

    public function destroy(Contract $contract)
    {
        $contract->delete();
        return redirect()->route('contracts.index');
    }

    public function terminate(Contract $contract)
    {
        $contract->update(['isTerminated' => !$contract->isTerminated]);
        return redirect()->route('contracts.show', $contract);
    }
}
