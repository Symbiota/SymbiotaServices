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
                <ul>
                    <li><b>Invoice ID:</b> {{ $invoice->id }}</li>
                    <li><b>Contract ID:</b> {{ $invoice->contract_id }}</li>
                    <li><b>Customer:</b> {{ $invoice->contract->customer_id }} -
                        {{ $invoice->contract->customer->name }}</li>
                    @isset($invoice->contract->customer->department_name)
                        <li class="ml-8"><b>
                                Department Name:</b>
                            {{ $invoice->contract->customer->department_name }}
                        </li>
                    @endisset
                    <li><b>Billing Start Date:</b> {{ $invoice->billing_start }}
                    </li>
                    <li><b>Billing End Date:</b> {{ $invoice->billing_end }}
                    </li>
                    <li><b>Amount Billed:</b> ${{ $invoice->amount_billed }}
                    </li>
                    <b>Services:</b>
                    @foreach ($invoice->services as $service)
                        <p class="ml-8">
                            {{ $service->name }}:
                            ${{ $service->pivot->amount_owed }}
                            ({{ $service->pivot->qty }})
                        </p>
                    @endforeach
                    <li><b>Date Paid:</b>
                        @if (isset($invoice->date_paid))
                            {{ $invoice->date_paid }}
                        @else
                            <b class="text-red-500">NOT PAID</b>
                        @endif
                    </li>
                </ul>
            </a>
        @endforeach
    </div>

</x-table-layout>
