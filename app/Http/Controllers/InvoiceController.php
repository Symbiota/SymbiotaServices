<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Service;
use App\Models\Contract;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('invoices.index', ['invoices' => Invoice::orderBy('id', 'desc')->get()]);
    }

    public function show(Invoice $invoice)
    {
        return view('invoices.show', [
            'invoice' => $invoice,
        ]);
    }

    public function sort(Request $request)
    {
        $sort = $request->input('sort');
        if ($sort == "billing_end") {
            $invoices = Invoice::orderBy('billing_end', 'desc')->get();
        } elseif ($sort == "date_paid") {
            $invoices = Invoice::orderBy('date_paid')->get();
        } else {
            $invoices = Invoice::orderBy('id', 'desc')->get();
        }
        return view('invoices.index', ['invoices' => $invoices])
            ->fragmentIf(request()->hasHeader('HX-Request'), 'invoice-list');;
    }

    public function create(Contract $contract, Invoice $invoice)
    {
        $contracts = Contract::select('contracts.*')
            ->join('customers', 'customers.id', '=', 'contracts.customer_id')
            ->orderBy('customers.name')
            ->get();

        $invoice['billing_start'] = $invoice['billing_end'] = $invoice['date_invoiced'] = $invoice['date_paid'] = null;

        return view('invoices.create', [
            'contract' => $contract,
            'invoice' => $invoice,
            'contracts' => $contracts,
            'services' => Service::all(),
            'contacts' => Contact::orderBy('last_name')->get(),
        ]);
    }

    public function edit(Request $request, Invoice $invoice)
    {
        $isHTMX = $request->hasHeader('HX-Request');

        return view('invoices.edit', [
            'isHTMX' => $isHTMX,
            'invoice' => $invoice,
            'services' => Service::all(),
            'contacts' => Contact::orderBy('last_name')->get(),
            'contracts' => Contract::select('contracts.*')
                ->join('customers', 'customers.id', '=', 'contracts.customer_id')
                ->orderBy('customers.name')->get(),
        ])->fragmentIf($isHTMX, 'edit-invoice');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'contract_id' => ['required', 'exists:contracts,id'],
            'financial_contact_id' => ['required', 'exists:contacts,full_name'],
            'billing_start' => ['required', 'date_format:Y-m-d'],
            'billing_end' => ['required', 'date_format:Y-m-d'],
            'amount_billed' => ['required', 'numeric:strict'],
            'date_invoiced' => ['nullable', 'date_format:Y-m-d'],
            'date_paid' => ['nullable', 'date_format:Y-m-d'],
            'services' => ['required'],
            'darbi_header_ref_1' => ['nullable', 'max:20'],
            'darbi_header_ref_2' => ['nullable', 'max:20'],
            'notes' => ['nullable'],
        ]);

        $financialContact = Contact::where('full_name', $data['financial_contact_id'])->firstOrFail();
        $data['financial_contact_id'] = $financialContact->id;

        $invoice = Invoice::create($data);

        $services = request('services');
        $qtys = request('qty');
        $amounts_owed = request('amount_owed');
        $line_ref_1 = request('line_ref_1');
        $line_ref_2 = request('line_ref_2');

        $serviceData = [];
        foreach ($services as $service_id) {
            $serviceData[$service_id] = ['qty' => $qtys[$service_id], 'amount_owed' => $amounts_owed[$service_id], 'line_ref_1' => $line_ref_1[$service_id], 'line_ref_2' => $line_ref_2[$service_id]];
        }

        $invoice->services()->attach($serviceData);

        return redirect()->route('invoices.show', $invoice);
    }

    public function update(Request $request, Invoice $invoice)
    {
        $isHTMX = $request->hasHeader('HX-Request');

        try {
            $data = $request->validate([
                'contract_id' => ['required', 'exists:contracts,id'],
                'financial_contact_id' => ['required', 'exists:contacts,full_name'],
                'billing_start' => ['required', 'date_format:Y-m-d'],
                'billing_end' => ['required', 'date_format:Y-m-d'],
                'amount_billed' => ['required', 'numeric:strict'],
                'date_invoiced' => ['nullable', 'date_format:Y-m-d'],
                'date_paid' => ['nullable', 'date_format:Y-m-d'],
                'services' => ['required'],
                'darbi_header_ref_1' => ['nullable', 'max:20'],
                'darbi_header_ref_2' => ['nullable', 'max:20'],
                'notes' => ['nullable'],
            ]);

            $financialContact = Contact::where('full_name', $data['financial_contact_id'])->firstOrFail();
            $data['financial_contact_id'] = $financialContact->id;

            $invoice->update($data);
            $invoice->services()->detach();
            $services = request('services');
            $qtys = request('qty');
            $amounts_owed = request('amount_owed');
            $line_ref_1 = request('line_ref_1');
            $line_ref_2 = request('line_ref_2');

            $serviceData = [];
            foreach ($services as $service_id) {
                $serviceData[$service_id] = ['qty' => $qtys[$service_id], 'amount_owed' => $amounts_owed[$service_id], 'line_ref_1' => $line_ref_1[$service_id], 'line_ref_2' => $line_ref_2[$service_id]];
            }

            $invoice->services()->attach($serviceData);

            if ($isHTMX) {
                return response(null, 204)->header('HX-Redirect', route('invoices.show', $invoice));
            }
            return redirect()->route('invoices.show', $invoice);
        } catch (ValidationException $e) {

            if ($isHTMX) {
                return view('invoices.edit', [
                    'isHTMX' => $isHTMX,
                    'invoice' => $invoice,
                    'services' => Service::all(),
                    'contacts' => Contact::orderBy('last_name')->get(),
                    'contracts' => Contract::select('contracts.*')
                        ->join('customers', 'customers.id', '=', 'contracts.customer_id')
                        ->orderBy('customers.name')->get(),
                ])->withErrors($e->errors())->fragment('edit-invoice');
            }
            throw $e;
        }
    }

    public function exportCSV(Invoice $invoice)
    {
        $customer_name = preg_replace('/\s+/', '', $invoice->contract->customer->name);
        $filename = 'BillingInformation_' . $customer_name . '_' . date('Y-m-d') . '.csv';

        $sanitizedFilename = preg_replace('/[^a-zA-Z0-9_\-\.]/', '_', $filename);
        $handle = fopen($sanitizedFilename, 'w');

        $headers = [
            ['Submitted  by (Required)',],
            [
                'NAME',
                'EMAIL',
                'PHONE',
                'REQUEST DATE',
            ],
            [
                auth()->user()->name, // Works, inputs user name
                auth()->user()->email,
                '',
                date('m/d/Y'), // Current date
            ],
            [],
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
            'RSINT', // BUSINESS UNIT - KUINT or RSINT
            'KUCR Symbiota', // BILLING UNIT/DEPARTMENT NAME
            '1 - ' . $invoice->contract->customer->name,
            $invoice->contract->customer->darbi_customer_account_number,
            $invoice->contract->customer->darbi_site,
            $invoice->financial_contact->first_name . ' ' . $invoice->financial_contact->last_name, // NOTE: Invoice Financial Contact
            $invoice->services[0]->darbi_item_number,
            $invoice->services[0]->name, // Item Description
            'Nico Franz', // SALESPERSON
            $invoice->services[0]->pivot->qty,
            'EA', // UOM
            $invoice->services[0]->price_per_unit,
            '$ ' . $invoice->services[0]->pivot->amount_owed,
            $invoice->billing_start, // NOTE: Billings Notes has MM/DD/YYYY, current settings is YYYY-MM-DD
            $invoice->billing_end,
            $invoice->darbi_header_ref_1,
            $invoice->darbi_header_ref_2,
            $invoice->services[0]->pivot->line_ref_1,
            $invoice->services[0]->pivot->line_ref_2,
            $invoice->contract->darbi_special_instructions,
            'Symbiota Internal Invoice ID: #' . $invoice->id,
        ];

        fputcsv($handle, $data);

        for ($i = 1; $i < count($invoice->services); $i++) {
            $item_row = [
                'RSINT',
                'KUCR Symbiota',
                '1 - ' . $invoice->contract->customer->name,
                $invoice->contract->customer->darbi_customer_account_number,
                $invoice->contract->customer->darbi_site,
                $invoice->financial_contact->first_name . ' ' . $invoice->financial_contact->last_name,
                $invoice->services[$i]->darbi_item_number,
                $invoice->services[$i]->name,
                'Nico Franz',
                $invoice->services[$i]->pivot->qty,
                'EA',
                $invoice->services[$i]->price_per_unit,
                '$ ' . $invoice->services[$i]->pivot->amount_owed,
                $invoice->billing_start,
                $invoice->billing_end,
                $invoice->darbi_header_ref_1,
                $invoice->darbi_header_ref_2,
                $invoice->services[$i]->pivot->line_ref_1,
                $invoice->services[$i]->pivot->line_ref_2,
                $invoice->contract->darbi_special_instructions,
                'Symbiota Internal Invoice ID: #' . $invoice->id,
            ];

            fputcsv($handle, $item_row);
        }

        fclose($handle);

        return response()->download(public_path($sanitizedFilename))->deleteFileAfterSend(true);
    }
}
