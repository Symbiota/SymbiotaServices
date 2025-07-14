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
        return view('contracts.show', compact('contract'));
    }

}
