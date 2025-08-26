<x-table-layout heading="Contacts">
    <title>CONTACTS PAGE</title>

    <div class="flex items-center">
        <x-ec-button onclick="toggleView('create-form')">Create
            Contact</x-ec-button>

        @if ($errors->any())
            <p class="text-red-500 text-sm ml-3"> Error Creating Contact</p>
        @endif
    </div>

    <div id="create-form" style="display:none;">
        <x-contact-form action="/contacts/create"></x-contact-form>
    </div>

    <script src="{{ asset('show-hide.js') }}"></script>

    <br>

    <div class = "space-y-4">
        @foreach ($contacts as $contact)
            <a href="/contacts/{{ $contact->id }}"
                class="block px-4 py-6 border border-gray-500">
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
