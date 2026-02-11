<x-table-layout heading="Invoice: {{ $invoice->id }}">
    <title>Invoice: {{ $invoice->id }} - SymbiotaServices</title>

    <ul>
        <li><b>Invoice ID:</b> {{ $invoice->id }}</li>
        <li><a href="{{ route('contracts.show', $invoice->contract) }}">
                <b class="text-blue-700 underline decoration-2">
                    Contract ID:</b> {{ $invoice->contract_id }}</a></li>
        <li><a
                href="{{ route('customers.show', $invoice->contract->customer) }}"><b
                    class="text-blue-700 underline decoration-2">Customer:</b>
                {{ $invoice->contract->customer->id }} -
                {{ $invoice->contract->customer->name }}</a></li>
        <li><a href="{{ route('contacts.show', $invoice->financial_contact) }}"
                hx-get="{{ route('contacts.show', $invoice->financial_contact) }}"
                hx-target="#modal" hx-swap="innerHTML"
                onclick="toggleView('modal-container')">
                <b class="text-blue-700 underline decoration-2">Financial
                    Contact:</b>
                {{ $invoice->financial_contact_id }} -
                {{ $invoice->financial_contact->first_name }}
                {{ $invoice->financial_contact->last_name }}</a>
        </li>
        <br>
        <li><b>Billing Start Date:</b> {{ $invoice->billing_start }}</li>
        <li><b>Billing End Date:</b> {{ $invoice->billing_end }}</li>
        <br>
        <li><b>Total Amount Billed:</b> ${{ $invoice->amount_billed }}</li>
        <br>
        <li><b>Date Invoiced:</b> {{ $invoice->date_invoiced }}</li>
        <li><b>Date Paid:</b>
            @if (isset($invoice->date_paid))
                {{ $invoice->date_paid }}
            @else
                <b class="text-red-500">NOT PAID</b>
            @endif
        </li>
        <br>
        <li><b>DARBI Header Ref 1:</b> {{ $invoice->darbi_header_ref_1 }}</li>
        <li><b>DARBI Header Ref 2:</b> {{ $invoice->darbi_header_ref_2 }}</li>
        <li><b>Notes:</b> {{ $invoice->notes }}</li>
        <x-timestamps :model="$invoice"></x-timestamps>
    </ul>

    <br>

    <div class="flex items-start">

        <x-ec-button href="{{ route('invoices.exportCSV', $invoice) }}">Export
            CSV</x-ec-button>

        <x-ec-button
            href="{{ route('invoices.create', [$invoice->contract, $invoice]) }}">Duplicate
            Invoice</x-ec-button>

        <x-ec-button href="{{ route('invoices.edit', $invoice) }}"
            hx-get="{{ route('invoices.edit', $invoice) }}" hx-target="#modal"
            hx-swap="innerHTML" onclick="toggleView('modal-container')">Edit
            Invoice</x-ec-button>

    </div>

    <br>

    @foreach ($invoice->services as $service)
        <a href="{{ route('services.show', $service) }}"
            hx-get="{{ route('services.show', $service) }}" hx-target="#modal"
            hx-swap="innerHTML" onclick="toggleView('modal-container')">
            <ul class="block px-4 py-2 border border-gray-500">
                @if ($service->active_status == 0)
                    <li><b>(RETIRED)</b></li>
                @endif
                <li><b>Name:</b> {{ $service->name }}</li>
                <li><b>Service ID:</b> {{ $service->id }}</li>
                <li><b>DARBI Item Number:</b>
                    {{ $service->darbi_item_number }}
                </li>
                <li><b>Description:</b> {{ $service->description }}</li>
                <li><b>Price per unit:</b> ${{ $service->price_per_unit }}</li>
                @isset($service->pivot->line_ref_1)
                    <li><b>Line Ref 1:</b> {{ $service->pivot->line_ref_1 }}</li>
                @endisset
                @isset($service->pivot->line_ref_2)
                    <li><b>Line Ref 2:</b> {{ $service->pivot->line_ref_2 }}</li>
                @endisset
                <br>
                <li><b>Quantity:</b> {{ $service->pivot->qty }}</li>
                <li><b>Amount Due:</b> ${{ $service->pivot->amount_owed }}
                </li>
            </ul>
        </a>
        <br>
    @endforeach

</x-table-layout>
