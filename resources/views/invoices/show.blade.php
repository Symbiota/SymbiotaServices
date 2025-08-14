<x-table-layout heading="Invoice: {{ $invoice->id }}">
    <title>Invoice: {{ $invoice->id }}</title>

    <ul>
        <li><b>Invoice ID:</b> {{ $invoice->id }}</li>
        <li><a href="/contracts/{{ $invoice->contract_id }}"><b>Contract ID:</b>
                {{ $invoice->contract_id }}</a></li>
        <li><b>Billing Start Date:</b> {{ $invoice->billing_start }}</li>
        <li><b>Billing End Date:</b> {{ $invoice->billing_end }}</li>
        <li><b>Amount Billed:</b> {{ $invoice->amount_billed }}</li>
        <li><b>Date Invoiced:</b> {{ $invoice->date_invoiced }}</li>
        <li><b>Date Paid:</b> {{ $invoice->date_paid }}</li>
        <li><b>Notes:</b> {{ $invoice->notes }}</li>
    </ul>

    <br>

    @foreach ($invoice->services as $service)
        <a href="/services/{{ $service->id }}">
            <ul class="block px-4 py-2 border border-gray-500">
                <li><b>
                        @if ($service->active_status == 0)
                            (RETIRED)
                        @endif
                    </b></li>
                <li><b>Service ID:</b> {{ $service->id }}</li>
                <li><b>Service Name:</b> {{ $service->name }}</li>
                <li><b>Quantity:</b> {{ $service->pivot->qty }}
                </li>
                <li><b>Description:</b> {{ $service->description }}</li>
                <li><b>Price per unit:</b> {{ $service->price_per_unit }}</li>
                <li><b>DARBI Item Number:</b> {{ $service->darbi_item_number }}
                </li>
            </ul>
        </a>
        <br>
    @endforeach

</x-table-layout>
