<?php

namespace App\Http\Controllers;
use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index() {
        return view('contracts.index', ['contracts' => Contract::all()]);
    }

    public function show(Contract $contract) {
        return view('contracts.show', ['contract' => $contract]);
    }

    public function create() {
        return view('contracts.create');
    }

    public function store() {
        request()->validate([
            'customer_id' => ['required'],
            'original_contact_id' => ['required'],
            'darbi_header_ref_1' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required']
        ]);

        Contract::create([
            'customer_id' => request('customer_id'),
            'original_contact_id' => request('original_contact_id'),
            'darbi_header_ref_1' => request('darbi_header_ref_1'),
            'darbi_header_ref_2' => request('darbi_header_ref_2'),
            'darbi_special_instructions' => request('darbi_special_instructions'),
            'notes' => request('notes'),
            'start_date' => request('start_date'),
            'end_date' => request('end_date'),
        ]);

        return redirect('/contracts');
    }

}
