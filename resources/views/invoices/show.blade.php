<x-table-layout heading="Invoice: {{ $invoice->id }}">
    <title>Invoice: {{ $invoice->id }}</title>

    <ul>
        <li><b>Invoice ID:</b> {{ $invoice->id }}</li>
        <li><a href="/contracts/{{ $invoice->contract_id }}"><b>Contract ID:</b>
                {{ $invoice->contract_id }}</a></li>
        <li><b>Billing Start:</b> {{ $invoice->billing_start }}</li>
        <li><b>Amount Billed:</b> {{ $invoice->amount_billed }}</li>
        <li><b>Date Invoiced:</b> {{ $invoice->date_invoiced }}</li>
        <li><b>Date Paid:</b> {{ $invoice->date_paid }}</li>
        <li><b>Notes:</b> {{ $invoice->notes }}</li>
    </ul>

</x-table-layout>
