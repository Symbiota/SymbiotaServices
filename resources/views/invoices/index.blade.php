<x-table-layout heading="Invoices">
    <title>INVOICES PAGE</title>

    <a href="{{ route('invoices.create') }}"> <x-ec-button>Create
            Invoice</x-ec-button></a>

    <br>
    <br>

    <div class = "space-y-4">
        @foreach ($invoices as $invoice)
            <a href="{{ route('invoices.show', $invoice) }}"
                class="block px-4 py-6 border border-gray-500">
                <ul><b>Invoice ID:</b> {{ $invoice->id }}</ul>
                <ul><b>Contract ID:</b> {{ $invoice->contract_id }}</ul>
                <ul><b>Customer:</b> {{ $invoice->contract->customer_id }} -
                    {{ $invoice->contract->customer->name }}</ul>
                @isset($invoice->contract->customer->department_name)
                    <ul class="ml-8"><b>
                            Department Name:</b>
                        {{ $invoice->contract->customer->department_name }}
                    </ul>
                @endisset
                <ul><b>Billing Start Date:</b> {{ $invoice->billing_start }}
                </ul>
                <ul><b>Billing End Date:</b> {{ $invoice->billing_end }}</ul>
                <ul><b>Amount Billed:</b> ${{ $invoice->amount_billed }}</ul>
                <b>Services:</b>
                @foreach ($invoice->services as $service)
                    <p class="ml-8">
                        {{ $service->name }}:
                        ${{ $service->pivot->amount_owed }}
                        ({{ $service->pivot->qty }})
                    </p>
                @endforeach
                <ul><b>Date Paid:</b>
                    @if (isset($invoice->date_paid))
                        {{ $invoice->date_paid }}
                    @else
                        <b class="text-red-500">NOT PAID</b>
                    @endif
                </ul>
            </a>
        @endforeach
    </div>

</x-table-layout>
