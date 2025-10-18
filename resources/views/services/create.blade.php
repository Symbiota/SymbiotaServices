<x-table-layout heading="Create Service:">
    @fragment('create-service')
        <x-modal-header :isHTMX="$isHTMX">Create Service:
        </x-modal-header>
        @if ($isHTMX)
            <x-service-form class="-mt-4" hx-post="{{ route('services.store') }}"
                hx-target="#modal" hx-swap="innerHTML"></x-service-form>
        @else
            <x-service-form class="-mt-8"
                action="{{ route('services.store') }}"></x-service-form>
        @endif
    @endfragment
</x-table-layout>
