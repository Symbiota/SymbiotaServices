<x-table-layout heading="{{ $customer->name }}">
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
            </ul>
        </div>
    @endfragment

    <br>
    <div x-data="{ show: false }" @close-form.window="show=false">
        <button @click="show = true"
            class='relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300'>Edit
            Customer</button>

        <div id="edit-form" x-show="show">
            <x-customer-form :customer="$customer" :formMethod="'PATCH'"
                :formEndpoint="url('/customers/' . $customer->id)"></x-customer-form>
        </div>
    </div>

    <br>

    <a href="{{ route('contracts.create', $customer) }}"<x-ec-button>Create
        Contract</x-ec-button></a>

    <br>
    <br>

    <div>
        @foreach ($customer->contracts as $contract)
            <a href="/contracts/{{ $contract->id }}"
                class="block px-4 py-2 border border-gray-500">
                <div>
                    <b>Contract ID:</b> {{ $contract->id }}
                    <b>Customer ID:</b> {{ $contract->customer_id }}
                    <b>Original Contact ID:</b>
                    {{ $contract->original_contact_id }}
                    <br>
                    <b>Header Ref 1:</b> {{ $contract->darbi_header_ref_1 }}
                    <b>Header Ref 2:</b> {{ $contract->darbi_header_ref_2 }}
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
