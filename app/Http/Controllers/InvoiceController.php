<?php

namespace App\Http\Controllers;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index() {
        return view('invoices.index', ['invoices' => Invoice::all()]);
    }

    public function show(Invoice $invoice) {
        return view('invoices.show', ['invoice' => $invoice]);
    }

    /*
    public function update(Invoice $invoice) {
        request()->validate([
            'name' => ['required'],
            'darbi_item_number' => ['required', 'numeric'],
            'price_per_unit' => ['required', 'numeric'],
            'description' => ['required'],
        ]);

        $service->update([
            'name' => request('name'),
            'darbi_item_number' => request('darbi_item_number'),
            'price_per_unit' => request('price_per_unit'),
            'description' => request('description'),
        ]);

        return redirect('/services/' . $service->id);
    }

    public function store() {
        request()->validate([
            'name' => ['required'],
            'darbi_item_number' => ['required', 'numeric'],
            'price_per_unit' => ['required', 'numeric'],
            'description' => ['required'],
        ]);

        $service = Service::create([
            'name' => request('name'),
            'darbi_item_number' => request('darbi_item_number'),
            'price_per_unit' => request('price_per_unit'),
            'description' => request('description'),
        ]);

        return redirect('/services/' . $service->id);
    }
        */

}
