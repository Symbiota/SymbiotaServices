<?php

namespace App\Http\Controllers;
use App\Models\Invoice;
use App\Models\Service;
use App\Models\Contract;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index() {
        return view('invoices.index', ['invoices' => Invoice::all()]);
    }

    public function show(Invoice $invoice) {
        return view('invoices.show', ['invoice' => $invoice], ['services' => Service::all()]);
    }

    public function create(Contract $contract) {
        return view('invoices.create', ['services' => Service::all()], ['contract' => $contract]);
    }

    public function store() {
        request()->validate([
            'contract_id' => ['required', 'exists:contracts,id'],
            'billing_start' => ['required', 'date_format:Y-m-d'],
            'billing_end' => ['required', 'date_format:Y-m-d'],
            'amount_billed' => ['required', 'numeric'],
            //'date_invoiced' => ['date_format:Y-m-d'],
            //'date_paid' => ['date_format:Y-m-d'],
            'service' => ['required'],
        ]);

        $invoice = Invoice::create([
            'contract_id' => request('contract_id'),
            'billing_start' => request('billing_start'),
            'billing_end' => request('billing_end'),
            'amount_billed' => request('amount_billed'),
            'date_invoiced' => request('date_invoiced'),
            'date_paid' => request('date_paid'),
            'notes' => request('notes'),
        ]);

        $services = request('service');
        $qtys = request('qty');
        $amounts_owed = request('amount_owed');

        $data = [];
        foreach ($services as $service_id) {
            $data[$service_id] = ['qty' => $qtys[$service_id], 'amount_owed' => $amounts_owed[$service_id]];
        }

        $invoice->services()->attach($data);

        return redirect('/contracts/' . $invoice->contract_id);
    }

    public function update(Invoice $invoice) {

        $invoice->services()->detach();

        request()->validate([
            'contract_id' => ['required', 'exists:contracts,id'],
            'billing_start' => ['required', 'date_format:Y-m-d'],
            'billing_end' => ['required', 'date_format:Y-m-d'],
            'amount_billed' => ['required', 'numeric'],
            'date_invoiced' => ['date_format:Y-m-d'],
            'date_paid' => ['date_format:Y-m-d'],
            'service' => ['required'],
        ]);

        $invoice->update([
            'contract_id' => request('contract_id'),
            'billing_start' => request('billing_start'),
            'billing_end' => request('billing_end'),
            'amount_billed' => request('amount_billed'),
            'date_invoiced' => request('date_invoiced'),
            'date_paid' => request('date_paid'),
            'notes' => request('notes'),
        ]);

        $services = request('service');
        $qtys = request('qty');
        $amounts_owed = request('amount_owed');

        $data = [];
        foreach ($services as $service_id) {
            $data[$service_id] = ['qty' => $qtys[$service_id], 'amount_owed' => $amounts_owed[$service_id]];
        }

        $invoice->services()->attach($data);

        return redirect('/invoices/' . $invoice->id);
    }

}
