<x-table-layout heading="Contract: {{ $contract->id }}">
    <title>Contract: {{ $contract->id }}</title>

    <ul>
        <li><b>Contract ID:</b> {{ $contract->id }}</li>
        <li><a href="{{ route('customers.show', $contract->customer) }}"><b
                    class="text-blue-700 underline decoration-2">Customer
                    ID:</b>
                {{ $contract->customer_id }} -
                {{ $contract->customer->name }}</a></li>
        <li><a href="{{ route('contacts.show', $contract->original_contact) }}"><b
                    class="text-blue-700 underline decoration-2">Original Contact
                    ID:</b>
                {{ $contract->original_contact_id }} -
                {{ $contract->original_contact->first_name }}
                {{ $contract->original_contact->last_name }}</a>
        </li>
        <li><a
                href="{{ route('contacts.show', $contract->current_financial_contact) }}"><b
                    class="text-blue-700 underline decoration-2">Current
                    Financial Contact ID:</b>
                {{ $contract->current_financial_contact_id }} -
                {{ $contract->current_financial_contact->first_name }}
                {{ $contract->current_financial_contact->last_name }}</a>
        </li>
        <li>
            @if (isset($contract->pi_contact_id))
                <a href="{{ route('contacts.show', $contract->pi_contact) }}"><b
                        class="text-blue-700 underline decoration-2">PI Contact
                        ID:</b>
                    {{ $contract->pi_contact_id }} -
                    {{ $contract->pi_contact->first_name }}
                    {{ $contract->pi_contact->last_name }}
                </a>
            @else
                <b>PI Contact ID:</b> None
            @endif
        </li>
        <li>
            @if (isset($contract->technical_contact_id))
                <a
                    href="{{ route('contacts.show', $contract->technical_contact) }}"><b
                        class="text-blue-700 underline decoration-2">Technical
                        Contact ID:</b>
                    {{ $contract->technical_contact_id }} -
                    {{ $contract->technical_contact->first_name }}
                    {{ $contract->technical_contact->last_name }}
                </a>
            @else
                <b>Technical Contact ID:</b> None
            @endif
        </li>
        <li><b>DARBI Header Ref 1:</b> {{ $contract->darbi_header_ref_1 }}</li>
        <li><b>DARBI Header Ref 2:</b> {{ $contract->darbi_header_ref_2 }}</li>
        <li><b>DARBI Special Instructions:</b>
            {{ $contract->darbi_special_instructions }}</li>
        <li><b>Notes:</b> {{ $contract->notes }}</li>
        <x-timestamps :model="$contract"></x-timestamps>
    </ul>

    <br>

    <div class="flex items-start">

        <div class="flex-col items-center">
            <form method="POST"
                action="{{ route('contracts.destroy', $contract) }}">
                @csrf
                @method('DELETE')
                <x-ec-button type="submit"
                    onclick="return confirm('Delete this contract?');">Delete
                    Contract</x-ec-button>
            </form>
        </div>

        <a
            href="{{ route('customers.exportCSV', ['customer' => $contract->customer, 'contract' => $contract]) }}"><x-ec-button>Export
                Customer CSV</x-ec-button></a>

        <a href="{{ route('invoices.create', $contract) }}"><x-ec-button>Create
                Invoice</x-ec-button></a>

        <a href="{{ route('contracts.edit', $contract) }}">
            <x-ec-button hx-get="{{ route('contracts.edit', $contract) }}"
                hx-target="#modal" hx-swap="innerHTML"
                onclick="toggleView('modal-container')">Edit
                Contract</x-ec-button>
        </a>

    </div>

    <br>

    @foreach ($contract->invoices as $invoice)
        <a href="{{ route('invoices.create', [$contract, $invoice]) }}"><x-ec-button>Create
                Invoice</x-ec-button></a>
        <a href="{{ route('invoices.show', $invoice) }}">
            <ul class="block px-4 py-2 border border-gray-500">
                <li><b>Invoice ID:</b> {{ $invoice->id }}</li>
                <li><b>Contract ID:</b> {{ $invoice->contract_id }}
                </li>
                <li><b>Billing Start Date:</b>
                    {{ $invoice->billing_start }}
                </li>
                <li><b>Billing End Date:</b>
                    {{ $invoice->billing_end }}
                </li>
                <li><b>Total Amount Billed:</b> ${{ $invoice->amount_billed }}
                </li>
                <li><b>Date Invoiced:</b> {{ $invoice->date_invoiced }}
                </li>
                <li><b>Date Paid:</b>
                    @if (isset($invoice->date_paid))
                        {{ $invoice->date_paid }}
                    @else
                        <b class="text-red-500">NOT PAID</b>
                    @endif
                </li>
                <li><b>Notes:</b> {{ $invoice->notes }}</li>
                <b>Services:</b>
                @foreach ($invoice->services as $service)
                    <p class="ml-8">
                        {{ $service->name }}:
                        ${{ $service->pivot->amount_owed }}
                        ({{ $service->pivot->qty }})
                    </p>
                @endforeach
            </ul>
        </a>
        <br>
    @endforeach

</x-table-layout>
