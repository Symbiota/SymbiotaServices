<x-table-layout heading="Contacts">
    <title>Contacts - SymbiotaServices</title>

    <div class="flex items-center">

        <x-ec-button href="{{ route('contacts.create') }}"
            hx-get="{{ route('contacts.create') }}" hx-target="#modal"
            hx-swap="innerHTML" onclick="toggleView('modal-container')">Create
            Contact</x-ec-button>

        <div class="flex items-center ml-auto">
            <x-ec-button href="{{ route('contacts.index') }}" class="!mr-2">Reset
            </x-ec-button>
            <form action="{{ route('contacts.search') }}" method="GET">
                <input
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300"
                    type="text" name="search" placeholder="Search Contacts"
                    list="contact-datalist">
                <x-ec-button class="!ml-1">⌕</x-ec-button>
            </form>
        </div>

        <datalist id="contact-datalist">
            @foreach ($allContactsList as $listContact)
                <option
                    value="{{ $listContact->first_name }} {{ $listContact->last_name }}">
                </option>
            @endforeach
        </datalist>

    </div>

    <br>

    <div class="space-y-4">
        @if (count($contacts) == 0)
            <div class="px-4 text-center text-2xl text-gray-700">
                <p>No contacts found.</p>
                <a class="text-blue-700 underline decoration-2 inline-block mt-3"
                    href="{{ route('contacts.index') }}">Back to Contacts
                    Page</a>
            </div>
        @endif
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
