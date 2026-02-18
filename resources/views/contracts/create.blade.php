<x-table-layout heading="Create Contract">
    <title>Create Contract - SymbiotaServices</title>

    <x-ec-button class="float-right !-ml-32" href="{{ route('contacts.create') }}"
        hx-get="{{ route('contacts.create') }}" hx-target="#modal"
        hx-swap="innerHTML" onclick="toggleView('modal-container')">Create
        Contact</x-ec-button>

    <x-contract-form class="-mt-8" :customer="$customer" :customers="$customers"
        :contacts="$contacts"
        action="{{ route('contracts.store') }}"></x-contract-form>

</x-table-layout>
