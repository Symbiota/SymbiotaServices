<x-table-layout heading="Contract: {{ $contract->id }}">
    <title>Contract: {{ $contract->id }}</title>

    <ul>
        <li><b>Contract ID:</b> {{ $contract->id }}</li>
        <li><a href="/customers/{{ $contract->customer_id }}"><b
                    class="text-blue-700 underline decoration-2">Customer
                    ID:</b>
                {{ $contract->customer_id }}</a></li>
        <li><a href="/contacts/{{ $contract->original_contact_id }}"><b
                    class="text-blue-700 underline decoration-2">Original Contact
                    ID:</b>
                {{ $contract->original_contact_id }} -
                {{ $contract->original_contact->first_name }}
                {{ $contract->original_contact->last_name }}</a></li>
        </li>
        <li><a href="/contacts/{{ $contract->current_financial_contact_id }}"><b
                    class="text-blue-700 underline decoration-2">Current
                    Financial Contact ID:</b>
                {{ $contract->current_financial_contact_id }} -
                {{ $contract->current_financial_contact->first_name }}
                {{ $contract->current_financial_contact->last_name }}</a></li>
        </li>
        <li>
            @if (isset($contract->pi_contact_id))
                <a href="/contacts/{{ $contract->pi_contact_id }}"><b
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
        </li>
        <li>
            @if (isset($contract->technical_contact_id))
                <a href="/contacts/{{ $contract->pi_contact_id }}"><b
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
        </li>
        <li><b>DARBI Header Ref 1:</b> {{ $contract->darbi_header_ref_1 }}
        </li>
        <li><b>DARBI Header Ref 2:</b> {{ $contract->darbi_header_ref_2 }}
        </li>
        <li><b>DARBI Special Instructions:</b>
            {{ $contract->darbi_special_instructions }}</li>
        <li><b>Notes:</b> {{ $contract->notes }}</li>
    </ul>

    <br>

    <div class="flex items-start">

        <div class="flex-col items-center">
            <x-ec-button onclick="toggleView('delete-form')">Delete
                Contract</x-ec-button>

            <div id="delete-form" style="display:none;" class="-mt-2">
                <form method="POST" action="/contracts/{{ $contract->id }}">
                    @csrf
                    @method('DELETE')
                    <br>
                    <p class="ml-7 mb-3">Are you sure?</p>
                    <x-ec-button type="submit"
                        class="hover:text-red-500">YES</x-ec-button>
                    <x-ec-button type="button"
                        onclick="toggleView('delete-form')"
                        class="hover:text-red-500">NO</x-ec-button>
                </form>
            </div>
        </div>

        <a href="{{ route('invoices.create', $contract) }}"<x-ec-button>Create
            Invoice</x-ec-button></a>

        <div class="flex items-center">
            <x-ec-button onclick="toggleView('edit-form')">Edit
                Contract</x-ec-button>

            @if ($errors->any())
                <p class="text-red-500 text-sm ml-3"> Error Editing Contract
                </p>
            @endif
        </div>

    </div>

    <script src="{{ asset('show-hide.js') }}"></script>

    <div id="edit-form" style="display:none;">
        <x-contract-form :contract="$contract"
            :contacts="$contacts">@method('PATCH')</x-contract-form>
    </div>

    <br>

    @foreach ($contract->invoices as $invoice)
        <a href="/invoices/{{ $invoice->id }}">
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
                <li><b>Date Paid:</b> {{ $invoice->date_paid }}</li>
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
