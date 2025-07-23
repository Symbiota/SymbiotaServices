<x-table-layout heading="Contacts">
    <title>CONTACTS PAGE</title>
        
    <div class = "space-y-4">
        @foreach ($contacts as $contact)
            <a href="/contacts/{{ $contact->id }}" class="block px-4 py-6 border border-gray-500">
                <b>Contact ID: {{ $contact->id }}</b>
                <br>
                <b>Name:</b> {{ $contact->first_name }} {{ $contact->last_name }}
            </a>
        @endforeach
    </div>
</x-table-layout>