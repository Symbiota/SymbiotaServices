<x-table-layout heading="Create Contract">
    <title>Create Contract - SymbiotaServices</title>

    <div class="flex items-start">
        <div class="w-4/5">
            <x-contract-form class="-mt-8" :customer="$customer" :customers="$customers"
                :contacts="$contacts"
                action="{{ route('contracts.store') }}"></x-contract-form>
        </div>

        <x-ec-button href="{{ route('contacts.create') }}"
            hx-get="{{ route('contacts.create') }}" hx-target="#modal"
            hx-swap="innerHTML" onclick="toggleView('modal-container')">Create
            Contact</x-ec-button>
    </div>

</x-table-layout>
