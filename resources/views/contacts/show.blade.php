<x-table-layout heading="Contact: {{ $contact->id }}">
    <title>Contact: {{ $contact->id }}</title>

    <ul>
        <li><b>Contact ID:</b> {{ $contact->id }}</li>
        <li><b>Name:</b> {{ $contact->first_name }} {{ $contact->last_name }}
        </li>
        <li><b>Email:</b> {{ $contact->email }}</li>
        <li><b>Notes:</b> {{ $contact->notes }}</li>
    </ul>

</x-table-layout>
