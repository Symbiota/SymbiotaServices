<x-table-layout heading="Invoices">
    <title>Invoices - SymbiotaServices</title>

    <div class="flex items-center">
        <x-ec-button href="{{ route('invoices.create') }}">Create
            Invoice</x-ec-button>

        <div class="flex items-center ml-auto">
            <form action="{{ route('invoices.sort') }}" method="GET">
                @csrf
                <label for="sort">
                    <select
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300"
                        name="sort" id="sort"
                        hx-get="{{ route('invoices.sort') }}"
                        hx-target="#invoice-list-div" hx-trigger="change"
                        onchange="if(!window.htmx) this.form.submit();">
                        <option>Recent</option>
                        <option value="billing_end">Billing End Date</option>
                        <option value="date_paid">Payment Status</option>
                    </select>
                </label>
            </form>
        </div>

    </div>
>>>>>>> Stashed changes

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
