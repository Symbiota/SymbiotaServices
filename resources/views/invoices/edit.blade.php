<x-table-layout heading="Edit Invoice {{ $invoice->id }}:">
    @fragment('edit-invoice')
        <x-modal-header :isHTMX="$isHTMX">Edit Invoice {{ $invoice->id }}:
        </x-modal-header>
        @if ($isHTMX)
            <x-invoice-form :invoice="$invoice" :services="$services" :contacts="$contacts"
                hx-post="{{ route('invoices.update', $invoice) }}" hx-target="#modal"
                hx-swap="innerHTML">@method('PATCH')</x-invoice-form>
        @else
            <x-invoice-form action="{{ route('invoices.edit', $invoice) }}"
                class="-mt-8" :invoice="$invoice" :services="$services"
                :contacts="$contacts">@method('PATCH')</x-service-form>
        @endif
    @endfragment
</x-table-layout>
