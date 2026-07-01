<x-table-layout heading="Create Contact:">
    @fragment('create-contact')
        <title>Create Contact - SymbiotaServices</title>
        <x-modal-header :isHTMX="$isHTMX">Create Contact:
        </x-modal-header>
        @if ($isHTMX)
            <x-forms.contact-form :errors="$errors" class="-mt-4"
                hx-post="{{ route('contacts.store') }}" hx-target="#modal"
                hx-swap="innerHTML scroll:top"></x-forms.contact-form>
        @else
            <x-forms.contact-form class="-mt-8"
                action="{{ route('contacts.store') }}"></x-forms.contact-form>
        @endif
    @endfragment
</x-table-layout>
