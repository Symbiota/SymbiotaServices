<?php

namespace App\Http\Controllers;
use App\Models\Invoice;
use App\Models\Service;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index() {
        return view('invoices.index', ['invoices' => Invoice::all()]);
    }

    public function show(Invoice $invoice) {
        return view('invoices.show', ['invoice' => $invoice]);
    }

    public function create() {
        return view('invoices.create', ['services' => Service::all()]);
    }

    public function store() {
        request()->validate([
            'contract_id' => ['required', 'exists:contracts,id'],
            'billing_start' => ['required', 'date_format:Y-m-d'],
            'billing_end' => ['required', 'date_format:Y-m-d'],
            'amount_billed' => ['required', 'numeric'],
            //'date_invoiced' => ['date_format:Y-m-d'],
            //'date_paid' => ['date_format:Y-m-d'],
        ]);

        $invoice = Invoice::create([
            'contract_id' => request('contract_id'),
            'billing_start' => request('billing_start'),
            'billing_end' => request('billing_end'),
            'amount_billed' => request('amount_billed'),
            'date_invoiced' => request('date_invoiced'),
            'notes' => request('notes'),
        ]);

        $invoice->services()->attach(request('services'));

        return redirect('/contracts/' . $invoice->contract_id);
    }

}
