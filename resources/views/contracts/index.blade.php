<x-table-layout heading="Contracts">
    <title>CONTRACTS PAGE</title>

    <a :customer="$customer" href="/contracts/create" class='relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300'>Create Contract</a>

    <br>
    <br>
        
    <div class = "space-y-4">
        @foreach ($contracts as $contract)
            <a href="/contracts/{{ $contract['id'] }}" class="block px-4 py-6 border border-gray-500">
                <strong>Contract ID: {{ $contract['id'] }}</strong>
                <div>{{ $contract['start_date'] }}: {{ $contract['end_date'] }}</div>
            </a>
        @endforeach
    </div>
</x-table-layout>