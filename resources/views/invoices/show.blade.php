<x-table-layout heading="Invoice: {{ $invoice->id }}">
    <title>Invoice: {{ $invoice->id }}</title>

    <ul>
        <ul><b>Invoice ID:</b> {{ $invoice->id }}</ul>
        <ul><b>Contract ID:</b> {{ $invoice->contract_id }}</ul>
        <ul><b>Billing Start:</b> {{ $invoice->bilulng_start }}</ul>
        <ul><b>Amount Billed:</b> {{ $invoice->amount_billed }}</ul>
        <ul><b>Date Invoiced:</b> {{ $invoice->date_invoiced }}</ul>
        <ul><b>Date Paid:</b> {{ $invoice->date_paid }}</ul>
        <ul><b>Notes:</b> {{ $invoice->notes }}</ul>
    </ul>

</x-table-layout>
