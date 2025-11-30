<x-table-layout heading="Contact: {{ $contact->id }}">
    <title>Contact: {{ $contact->first_name }} {{ $contact->last_name }} -
        SymbiotaServices</title>

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

    <div id="edit-form" class="hidden">
        <x-contact-form action="{{ route('contacts.update', $contact) }}"
            :contact="$contact">@method('PATCH')</x-contact-form>
    </div>

</x-table-layout>
