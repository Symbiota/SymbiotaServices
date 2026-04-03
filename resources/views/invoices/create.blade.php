<x-table-layout heading="Create Invoice">
    <title>Create Invoice - SymbiotaServices</title>

    <x-ec-button class="float-right !-mt-20" href="{{ route('contacts.create') }}"
        hx-get="{{ route('contacts.create') }}" hx-target="#modal"
        hx-swap="innerHTML" onclick="toggleView('modal-container')">Create
        Contact</x-ec-button>

    <div>
        <x-invoice-form class="-mt-8" :contract="$contract" :contracts="$contracts"
            :services="$services" :contacts="$contacts" :invoice="$invoice"
            action="{{ route('invoices.store') }}"></x-invoice-form>
    </div>

</x-table-layout>
