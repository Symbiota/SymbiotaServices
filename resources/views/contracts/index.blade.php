<x-table-layout heading="Contracts">
    <title>Contracts - SymbiotaServices</title>

    <a href="{{ route('contracts.create') }}"><x-ec-button>Create
            Contract</x-ec-button></a>

    <br>
    <br>

    <div class="space-y-4">
        @foreach ($contracts as $contract)
            <a href="{{ route('contracts.show', $contract) }}"
                class="px-4 py-6 border border-gray-500 flex justify-between items-center">
                <ul>
                    <li><b>Contract ID:</b> {{ $contract->id }}</li>
                    <li><b>Customer:</b> {{ $contract->customer_id }} -
                        {{ $contract->customer->name }}</li>
                    @isset($contract->customer->department_name)
                        <li class="ml-8"><b>
                                Department Name:</b>
                            {{ $contract->customer->department_name }}
                        </li>
                    @endisset
                    <li><b>Original Contact:</b>
                        {{ $contract->original_contact_id }} -
                        {{ $contract->original_contact->first_name }}
                        {{ $contract->original_contact->last_name }}
                    </li>
                    @isset($contract->pi_contact)
                        <li><b>PI Contact:</b> {{ $contract->pi_contact_id }} -
                            {{ $contract->pi_contact->first_name }}
                            {{ $contract->pi_contact->last_name }}
                        </li>
                    @endisset
                </ul>
                <form method="POST"
                    action="{{ route('contracts.destroy', $contract) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="hover:text-red-500"
                        onclick="return confirm('Delete this contract?');">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="white"
                            viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </button>
                </form>
            </a>
        @endforeach
    </div>

</x-table-layout>
