<x-table-layout heading="{{ $service->name }}">
    <title>SERVICE: {{ $service->name }}</title>
        
    <ul>
        <li><b>Name:</b> {{ $service->name }}</li>
        <li><b>Darbi Item Number:</b> {{ $service->darbi_item_number }}</li>
        <li><b>Price per Unit:</b> {{ $service->price_per_unit }}</li>
        <li><b>Description:</b> {{ $service->description }}</li>
    </ul>

</x-table-layout>