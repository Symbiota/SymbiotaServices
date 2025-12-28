<x-table-layout heading="Contacts">
    <title>Contacts - SymbiotaServices</title>

    <div class="flex items-center">
        <x-ec-button href="{{ route('contacts.create') }}"
            hx-get="{{ route('contacts.create') }}" hx-target="#modal"
            hx-swap="innerHTML" onclick="toggleView('modal-container')">Create
            Contact</x-ec-button>
    </div>

    <br>

    <div class = "space-y-4">
        @foreach ($contacts as $contact)
            <a href="{{ route('contacts.show', $contact) }}"
                class="block px-4 py-6 border border-gray-500"
                hx-get="{{ route('contacts.show', $contact) }}"
                hx-target="#modal" hx-swap="innerHTML"
                onclick="toggleView('modal-container')">
                <ul>
                    <li><b>Contact ID:</b> {{ $contact->id }}</li>
                    <li><b>Name:</b> {{ $contact->first_name }}
                        {{ $contact->last_name }}</li>
                    <li><b>Email:</b> {{ $contact->email }}</li>
                    <li><b>Notes:</b> {{ $contact->notes }}</li>
                </ul>
            </a>
        @endforeach
    </div>
</x-table-layout>
