<x-table-layout heading="{{ $customer->name }}">
    <title>CUSTOMER: {{ $customer->name }}</title>
        
    <ul>
        <li><b>Name:</b> {{ $customer->name }}</li>
        <li><b>Darbi ID:</b>  {{ $customer->darbi_account }}</li>
        <li><b>Darbi site:</b>  {{ $customer->darbi_site }}</li>
        <!--<li><b>Correspondence:</b>  {{ $customer->correspondence }}</li>-->
        <li><b>Notes:</b>  {{ $customer->notes }}</li>
    </ul>

    <br>

    <button onclick="toggleEditForm()" class='relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300'>Edit Customer</button>

    <script>
        function toggleEditForm() {
            var form = document.getElementById("edit-form");
            if (form.style.display === "none") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }
    </script>

    <div id="edit-form" style="display:none;">
        <x-customer-form :customer="$customer">@method('PATCH')</x-customer-form>
    </div>

    <br>
    <br>

    <a href="/contracts/create" class='relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300'>Create Contract</a>

    <br>
    <br>

    <div>
        @foreach($customer->contracts as $contract)
            <a href="/contracts/{{ $contract->id }}" class="block px-4 py-2 border border-gray-500">
                <div>
                    <b>Contract ID:</b> {{ $contract->id }}
                    <b>Customer ID:</b> {{ $contract->customer_id }}
                    <b>Original Contact ID:</b> {{ $contract->original_contract_id }}
                    <br>
                    <b>Start Date:</b> {{ $contract->start_date }}
                    <b>End Date:</b> {{ $contract->end_date }}
                    <br>
                    <b>Header Ref 1:</b> {{ $contract->darbi_header_ref_1 }}
                    <b>Header Ref 2:</b> {{ $contract->darbi_header_ref_2 }}
                    <br>
                    <b>Special Instructions:</b> {{ $contract->darbi_special_instructions }}
                    <br>
                    <b>Notes:</b> {{ $contract->notes }}
                </div>
            </a>
            <br>
        @endforeach
    </div>

    <br>

</x-table-layout>