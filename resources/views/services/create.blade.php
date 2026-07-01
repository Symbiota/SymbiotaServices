<x-table-layout heading="Create Service:">
    @fragment('create-service')
        <title>Create Service - SymbiotaServices</title>
        <x-modal-header :isHTMX="$isHTMX">Create Service:
        </x-modal-header>
        @if ($isHTMX)
            <x-forms.service-form :errors="$errors" class="-mt-4"
                hx-post="{{ route('services.store') }}" hx-target="#modal"
                hx-swap="innerHTML scroll:top"></x-forms.service-form>
        @else
            <x-forms.service-form class="-mt-8"
                action="{{ route('services.store') }}"></x-forms.service-form>
        @endif
    @endfragment
</x-table-layout>
