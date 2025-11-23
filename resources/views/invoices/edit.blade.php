<x-table-layout heading="Edit Invoice {{ $invoice->id }}:">
    @fragment('edit-invoice')
        <x-modal-header :isHTMX="$isHTMX" :errors="$errors" model="Invoice">Edit
            Invoice{{ $invoice->id }}:</x-modal-header>
        @if ($isHTMX)
            <x-invoice-form hx-post="{{ route('invoices.update', $invoice) }}"
                hx-target="#modal" hx-swap="innerHTML scroll:top" :errors="$errors"
                :invoice="$invoice" :services="$services" :contracts="$contracts"
                :contacts="$contacts">@method('PATCH')</x-invoice-form>
        @else
            <x-invoice-form action="{{ route('invoices.update', $invoice) }}"
                class="-mt-8" :invoice="$invoice" :services="$services" :contracts="$contracts"
                :contacts="$contacts">@method('PATCH')</x-service-form>
        @endif
    @endfragment
</x-table-layout>
