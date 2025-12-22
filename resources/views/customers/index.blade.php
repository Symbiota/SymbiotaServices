<x-table-layout heading="Customers">
    <title>Customers - SymbiotaServices</title>

    <div class="flex items-center">

        <a href="{{ route('customers.create') }}"><x-ec-button>Create
                Customer</x-ec-button></a>

        <div class="flex items-center ml-auto">
            <a href="{{ route('customers.index') }}" <x-ec-button
                class="!mr-2">Reset
                </x-ec-button></a>
            <form action="{{ route('customers.search') }}" method="GET">
                <input
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300"
                    type="text" name="search" placeholder="Search Customers"
                    list="customer-datalist">
                <x-ec-button class="!ml-1">⌕</x-ec-button>
            </form>
        </div>

        <datalist id="customer-datalist">
            @foreach ($customers as $customer)
                <option value="{{ $customer->name }}"></option>
            @endforeach
        </datalist>

    </div>

    <br>

    @fragment('customer-list')
        <div class="space-y-4" id="customer-list-div">
            @if (count($customers) == 0)
                <div class="px-4 text-center text-2xl text-gray-700">
                    <p>No customers found.</p>
                    <a class="text-blue-700 underline decoration-2 inline-block mt-3"
                        href="{{ route('customers.index') }}">Back to
                        Customers Page</a>
                </div>
            @endif
            @foreach ($customers as $customer)
                <a href="{{ route('customers.show', $customer) }}"
                    class="px-4 py-6 border border-gray-500 flex justify-between items-center">
                    <ul>
                        <li><b>{{ $customer->name }}</b></li>
                        @isset($customer->department_name)
                            <li>Department: {{ $customer->department_name }}</li>
                        @endisset
                        <li>DARBI Account Number:
                            {{ $customer->darbi_customer_account_number }}
                        </li>
                    </ul>
                    <form hx-delete={{ route('customers.delete', $customer) }}
                        hx-target="#customer-list-div" hx-swap="outerHTML"
                        hx-confirm="Are you sure you want to delete this customer? All of their contracts would also be deleted."
                        hx-indicator="#loading-spinner-{{ $customer->id }}"
                        class="flex items-center">
                        @csrf
                        <button type="submit" class="hover:text-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="white"
                                viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                        <span class="htmx-indicator"
                            id="loading-spinner-{{ $customer->id }}">Deleting...</span>
                    </form>
                </a>
            @endforeach
        </div>
    @endfragment

</x-table-layout>
