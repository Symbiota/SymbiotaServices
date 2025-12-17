<x-table-layout heading="{!! $customer->name !!}">
    <title>CUSTOMER: {{ $customer->name }}</title>

    @fragment('customer-list')
        <div id="customer-list-div">
            <ul>
                <li><b>ID:</b> {{ $customer->id }}</li>
                <li><b>Name:</b> {{ $customer->name }}</li>
                <li><b>Department Name:</b> {{ $customer->department_name }}</li>
                <li><b>DARBI Customer Account Number:</b>
                    {{ $customer->darbi_customer_account_number }}</li>
                <li><b>DARBI site:</b> {{ $customer->darbi_site }}</li>
                <li><b>Notes:</b> {{ $customer->notes }}</li>
                <br>
                <li><b>Country:</b> {{ $customer->country }}</li>
                <li><b>State:</b> {{ $customer->state }}</li>
                <li><b>Zip Code:</b> {{ $customer->zip_code }}</li>
                <li><b>Address Line 1:</b> {{ $customer->address_line_1 }}</li>
                <li><b>Address Line 2:</b> {{ $customer->address_line_2 }}</li>
                <x-timestamps :model="$customer"></x-timestamps>
            </ul>
        </div>
    @endfragment

    <br>
    <div class="flex items-start">

        <a href="{{ route('contracts.create', $customer) }}"<x-ec-button>Create
            Contract</x-ec-button></a>

        <a href="{{ route('customers.edit', $customer) }}">
            <x-ec-button hx-get="{{ route('customers.edit', $customer) }}"
                hx-target="#modal" hx-swap="innerHTML"
                onclick="toggleView('modal-container')">Edit
                Customer</x-ec-button>
        </a>

    </div>

    <br>

    <div>
        @foreach ($customer->contracts as $contract)
            <a href="{{ route('contracts.show', $contract) }}"
                class="block px-4 py-2 border border-gray-500">
                <div>
                    <b>Contract ID:</b> {{ $contract->id }}
                    <b>Customer ID:</b> {{ $contract->customer_id }}
                    <b>Original Contact ID:</b>
                    {{ $contract->original_contact_id }}
                    <br>
                    <b>Header Ref 1:</b>
                    {{ $contract->darbi_header_ref_1 }}
                    <b>Header Ref 2:</b>
                    {{ $contract->darbi_header_ref_2 }}
                    <br>
                    <b>Special Instructions:</b>
                    {{ $contract->darbi_special_instructions }}
                    <br>
                    <b>Notes:</b> {{ $contract->notes }}
                    <br>
                </div>
            </a>
            <br>
        @endforeach
    </div>

    <br>

</x-table-layout>
