<x-table-layout heading="Contracts">
    <title>CONTRACTS PAGE</title>

    <a href="/contracts/create"> <x-ec-button>Create
            Contract</x-ec-button></a>

    <br>
    <br>

    <div class = "space-y-4">
        @foreach ($contracts as $contract)
            <a href="/contracts/{{ $contract->id }}"
                class="block px-4 py-6 border border-gray-500">
                <strong>Contract ID: {{ $contract->id }}</strong>
                <div>{{ $contract->start_date }}: {{ $contract->end_date }}
                </div>
            </a>
        @endforeach
    </div>

</x-table-layout>
