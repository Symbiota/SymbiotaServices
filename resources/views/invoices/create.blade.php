<x-table-layout heading="Create Invoice">
    <title>CREATE INVOICE</title>

    <x-invoice-form class="-mt-8" :contract="$contract" :services="$services"
        :contacts="$contacts" action="/invoices"></x-invoice-form>

</x-table-layout>
