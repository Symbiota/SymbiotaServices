<x-table-layout heading="Edit Customer {{ $customer->id }}:">
    @fragment('edit-customer')
        <x-modal-header :isHTMX="$isHTMX" :errors="$errors" model="Customer">Edit
            Customer {{ $customer->id }}:</x-modal-header>
        @if ($isHTMX)
            <x-customer-form hx-post="{{ route('customers.update', $customer) }}"
                hx-target="#modal" hx-swap="innerHTML scroll:top" :errors="$errors"
                :customer="$customer">@method('PATCH')</x-customer-form>
        @else
            <x-customer-form action="{{ route('customers.update', $customer) }}"
                class="-mt-8" :customer="$customer">@method('PATCH')</x-service-form>
        @endif
    @endfragment
</x-table-layout>
