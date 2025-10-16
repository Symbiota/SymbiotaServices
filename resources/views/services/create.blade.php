<x-table-layout heading="Create Service:">
    @fragment('create-service')
        <x-modal-header :isHTMX="$isHTMX">Create Service:
        </x-modal-header>
        <x-service-form class="-mt-4" hx-post="{{ route('services.store') }}"
            hx-target="#modal" hx-swap="innerHTML"></x-service-form>
    @endfragment
</x-table-layout>
