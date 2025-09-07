<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Service;
use App\Models\Contract;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('invoices.index', ['invoices' => Invoice::all()]);
    }

    public function show(Invoice $invoice)
    {
        return view('invoices.show', [
            'invoice' => $invoice,
            'services' => Service::all(),
            'contacts' => Contact::all(),
        ]);
    }

    public function create(Contract $contract)
    {
        return view('invoices.create', [
            'contract' => $contract,
            'services' => Service::all(),
            'contacts' => Contact::all()
        ]);
    }

    public function store()
    {
        request()->validate([
            'contract_id' => ['required', 'exists:contracts,id'],
            'financial_contact_id' => ['required', 'exists:contacts,id'],
            'billing_start' => ['required', 'date_format:Y-m-d'],
            'billing_end' => ['required', 'date_format:Y-m-d'],
            'amount_billed' => ['required', 'numeric'],
            'date_invoiced' => ['nullable', 'date_format:Y-m-d'],
            'date_paid' => ['nullable', 'date_format:Y-m-d'],
            'service' => ['required'],
        ]);

        $invoice = Invoice::create([
            'contract_id' => request('contract_id'),
            'financial_contact_id' => request('financial_contact_id'),
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

    public function update(Invoice $invoice)
    {
        $invoice->services()->detach();

        request()->validate([
            'contract_id' => ['required', 'exists:contracts,id'],
            'financial_contact_id' => ['required', 'exists:contacts,id'],
            'billing_start' => ['required', 'date_format:Y-m-d'],
            'billing_end' => ['required', 'date_format:Y-m-d'],
            'amount_billed' => ['required', 'numeric'],
            'date_invoiced' => ['nullable', 'date_format:Y-m-d'],
            'date_paid' => ['nullable', 'date_format:Y-m-d'],
            'service' => ['required'],
        ]);

        $invoice->update([
            'contract_id' => request('contract_id'),
            'financial_contact_id' => request('financial_contact_id'),
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

    public function exportCSV(Invoice $invoice)
    {
        $filename = 'invoice_' . $invoice->id . '.csv';
        $handle = fopen($filename, 'w');

        $headers = [
            ['Submitted  by (Required)',],
            ['NAME', 'EMAIL', 'PHONE', 'REQUEST DATE',
            ],
            [
                auth()->user()->name, // Works, inputs user name
                auth()->user()->email,
                '[PHONE LATER]',
                date('m/d/Y'), // Current date
            ],
            [],
            [
            'BUSINESS UNIT - KUINT or RSINT',
            'BILLING UNIT/DEPARTMENT NAME',
            'CUSTOMER NAME',
            'CUSTOMER ACCOUNT NUMBER',
            'CUSTOMER SITE NUMBER',
            'CUSTOMER CONTACT',
            'ITEM NUMBER',
            'ITEM DESCRIPTION',
            'SALESPERSON',
            'QUANTITY',
            'UOM',
            'PRICE',
            'LINE TOTAL',
            'BILL FROM DATE',
            'BILL TO DATE',
            'HEADER REFERENCE 1',
            'HEADER REFERENCE 2',
            'LINE REFERENCE 1',
            'LINE REFERENCE 2',
            'SPECIAL INSTRUCTIONS',
            'NOTES: INCLUDE INVOICE NUMBER AND LINE NUMBER IF CREDIT MEMO',
            ],
        ];

        foreach ($headers as $submit) {
            fputcsv($handle, $submit);
        }

        $data = [
            'KUINT/RSINT', // BUSINESS UNIT - KUINT or RSINT
            $invoice->contract->customer->department_name,
            $invoice->contract->customer->name,
            $invoice->contract->customer->darbi_customer_account_number,
            $invoice->contract->customer->darbi_site,
            $invoice->contact->first_name . ' ' . $invoice->contact->last_name, // NOTE: Invoice Financial Contact
            $invoice->services[0]->darbi_item_number,
            $invoice->services[0]->description,
            'SALESPERSON', // SALESPERSON
            $invoice->services[0]->pivot->qty,
            'UOM', // UOM
            $invoice->services[0]->price_per_unit,
            '$' . $invoice->services[0]->pivot->amount_owed,
            $invoice->billing_start, // NOTE: Billings Notes has MM/DD/YYYY, current settings is YYYY-MM-DD
            $invoice->billing_end,
            $invoice->contract->darbi_header_ref_1,
            $invoice->contract->darbi_header_ref_2,
            $invoice->services[0]->line_ref_1,
            $invoice->services[0]->line_ref_2,
            $invoice->contract->darbi_special_instructions,
            'Internal invoice ID: ' . $invoice->id,
        ];

        fputcsv($handle, $data);

        for ($i = 1; $i < count($invoice->services); $i++) {
            $item_row = ['',
            '',
            '',
            '',
            '',
            '',
            $invoice->services[$i]->darbi_item_number,
            $invoice->services[$i]->description,
            '',
            $invoice->services[$i]->pivot->qty,
            'UOM',
            $invoice->services[$i]->price_per_unit,
            '$' . $invoice->services[$i]->pivot->amount_owed,
            '',
            '',
            '',
            '',
            $invoice->services[$i]->line_ref_1,
            $invoice->services[$i]->line_ref_2,
            '',
            '',];

            fputcsv($handle, $item_row);
        }

        fclose($handle);

        return response()->download(public_path($filename))->deleteFileAfterSend(true);
    }
}
