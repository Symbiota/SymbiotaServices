<x-table-layout heading="Invoice: {{ $invoice->id }}">
    <title>Invoice: {{ $invoice->id }}</title>

    <ul>
        <li><b>Invoice ID:</b> {{ $invoice->id }}</li>
        <li><a href="{{ route('contracts.show', $invoice->contract_id) }}">
                <b class="text-blue-700 underline decoration-2">
                    Contract ID:</b> {{ $invoice->contract_id }}</a></li>
        <li><a href="/contacts/{{ $invoice->financial_contact_id }}">
                <b class="text-blue-700 underline decoration-2">Financial Contact
                    ID:</b>
                {{ $invoice->financial_contact_id }} -
                {{ $invoice->contact->first_name }}
                {{ $invoice->contact->last_name }}</a>
        </li>
        <li><b>Billing Start Date:</b> {{ $invoice->billing_start }}</li>
        <li><b>Billing End Date:</b> {{ $invoice->billing_end }}</li>
        <li><b>Total Amount Billed:</b> ${{ $invoice->amount_billed }}</li>
        <li><b>Date Invoiced:</b> {{ $invoice->date_invoiced }}</li>
        <li><b>Date Paid:</b> {{ $invoice->date_paid }}</li>
        <li><b>Notes:</b> {{ $invoice->notes }}</li>
    </ul>

    <br>

    <div class="flex items-start">

        <div>
            <a href="/invoices/{{ $invoice->id }}/exportCSV"<x-ec-button>Export
                CSV</x-ec-button></a>
        </div>

        <div class="flex items-center">
            <x-ec-button onclick="toggleView('edit-form')">Edit
                Invoice</x-ec-button>

            @if ($errors->any())
                <p class="text-red-500 text-sm ml-3"> Error Editing Invoice
                </p>
            @endif
        </div>

    </div>

    <div id="edit-form" style="display:none;">
        <x-invoice-form :invoice="$invoice" :services="$services"
            :contacts="$contacts">@method('PATCH')</x-invoice-form>
    </div>

    <br>

    @foreach ($invoice->services as $service)
        <a href="{{ route('services.show', $service) }}">
            <ul class="block px-4 py-2 border border-gray-500">
                <li><b>
                        @if ($service->active_status == 0)
                            (RETIRED)
                        @endif
                    </b></li>
                <li><b>Name:</b> {{ $service->name }}</li>
                <li><b>Service ID:</b> {{ $service->id }}</li>
                <li><b>DARBI Item Number:</b>
                    {{ $service->darbi_item_number }}
                </li>
                <li><b>Description:</b> {{ $service->description }}</li>
                <li><b>Price per unit:</b> ${{ $service->price_per_unit }}</li>
                <br>
                <li><b>Quantity:</b> {{ $service->pivot->qty }}</li>
                <li><b>Amount Paid:</b> ${{ $service->pivot->amount_owed }}
                </li>
            </ul>
        </a>
        <br>
    @endforeach

</x-table-layout>
