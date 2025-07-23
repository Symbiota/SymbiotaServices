<?php

namespace App\Http\Controllers;
use App\Models\Contract;
use App\Models\Customer;
use App\Models\Service;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index() {
        return view('contracts.index', ['contracts' => Contract::all()]);
    }

    public function show(Contract $contract) {
        return view('contracts.show', ['contract' => $contract]);
    }

    public function create(Customer $customer = null) {
        return view('contracts.create', ['customer' => $customer], ['services' => Service::all()]);
    }

    public function store() {
        request()->validate([
            'customer_id' => ['required'],
            'original_contact_id' => ['required'],
            'darbi_header_ref_1' => ['required'],
            'start_date' => ['required', 'date_format:Y-m-d'],
            'end_date' => ['required', 'date_format:Y-m-d'],
            'services' => ['required']
        ]);

        $contract = Contract::create([
            'customer_id' => request('customer_id'),
            'original_contact_id' => request('original_contact_id'),
            'darbi_header_ref_1' => request('darbi_header_ref_1'),
            'darbi_header_ref_2' => request('darbi_header_ref_2'),
            'darbi_special_instructions' => request('darbi_special_instructions'),
            'notes' => request('notes'),
            'start_date' => request('start_date'),
            'end_date' => request('end_date'),
        ]);

        $contract->services()->attach(request('services'));

        return redirect('/contracts');
    }

}
