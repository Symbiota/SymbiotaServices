<x-table-layout heading="Edit: {{ $service->name }}">
    @fragment('edit-service')
        <x-modal-header :isHTMX="$isHTMX">Edit: {{ $service->name }}
        </x-modal-header>
        <x-service-form class="-mt-4" :service="$service"
            action="{{ route('services.update', $service) }}">@method('PATCH')</x-service-form>
    @endfragment
</x-table-layout>
