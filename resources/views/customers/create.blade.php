<x-table-layout heading="Create Customer:">
    @fragment('create-customer')
        <x-customer-form class="-mt-8"
            action="{{ route('customers.store') }}"></x-customer-form>
    @endfragment
</x-table-layout>
