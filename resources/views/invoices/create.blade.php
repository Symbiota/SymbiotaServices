<x-table-layout heading="Create Invoice">
    <title>Create Invoice - SymbiotaServices</title>

    <div class="flex items-start">
        <div class="w-4/5">
            <x-invoice-form class="-mt-8" :contract="$contract" :contracts="$contracts"
                :services="$services" :contacts="$contacts" :invoice="$invoice"
                action="{{ route('invoices.store') }}"></x-invoice-form>
        </div>

        <x-ec-button href="{{ route('contacts.create') }}"
            hx-get="{{ route('contacts.create') }}" hx-target="#modal"
            hx-swap="innerHTML" onclick="toggleView('modal-container')">Create
            Contact</x-ec-button>
    </div>

</x-table-layout>
