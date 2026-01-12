<x-table-layout heading="Create Contact:">
    @fragment('create-contact')
        <title>Create Contact - SymbiotaServices</title>
        <x-modal-header :isHTMX="$isHTMX">Create Contact:
        </x-modal-header>
        @if ($isHTMX)
            <x-contact-form :errors="$errors" class="-mt-4"
                hx-post="{{ route('contacts.store') }}" hx-target="#modal"
                hx-swap="innerHTML scroll:top"></x-contact-form>
        @else
            <x-contact-form class="-mt-8"
                action="{{ route('contacts.store') }}"></x-contact-form>
        @endif
    @endfragment
</x-table-layout>
