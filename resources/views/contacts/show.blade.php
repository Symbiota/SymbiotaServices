<x-table-layout
    heading="Contact: {{ $contact->first_name }} {{ $contact->last_name }}">

    @fragment('show-contact')
        <title>Contact: {{ $contact->first_name }} {{ $contact->last_name }}</title>

        <x-modal-header :isHTMX="$isHTMX">{{ $contact->first_name }}
            {{ $contact->last_name }}
        </x-modal-header>

        <ul>
            <li><b>Contact ID:</b> {{ $contact->id }}</li>
            <li><b>Name:</b> {{ $contact->first_name }} {{ $contact->last_name }}
            </li>
            <li><b>Email:</b> {{ $contact->email }}</li>
            <li><b>Phone Number:</b> {{ $contact->phone_number }}</li>
            <li><b>Notes:</b> {{ $contact->notes }}</li>
            <x-timestamps :model="$contact"></x-timestamps>
        </ul>

        <br>

        <div class="flex items-start">
            <div class="flex items-center">
                <x-ec-button onclick="toggleView('edit-form')">Edit
                    Contact</x-ec-button>

                @if ($errors->contact_errors->any())
                    <p class="text-red-500 text-sm ml-3">Error Editing Contact
                    </p>
                @endif
            </div>
        </div>

        <div id="edit-form"
            class="{{ $errors->contact_errors->any() ? '' : 'hidden' }}">
            @if ($isHTMX)
                <x-contact-form class="-mt-2" :errors="$errors" :contact="$contact"
                    hx-post="{{ route('contacts.update', $contact) }}"
                    hx-target="#modal"
                    hx-swap="innerHTML scroll:top">@method('PATCH')</x-contact-form>
            @else
                <x-contact-form action="{{ route('contacts.update', $contact) }}"
                    :contact="$contact">@method('PATCH')</x-contact-form>
            @endif
        </div>
    @endfragment

</x-table-layout>
