<x-table-layout heading="Services">
    <title>SERVICES PAGE</title>

    <div class = "space-y-4">
        @foreach ($services as $service)
            <a href="/services/{{ $service->id }}" class="block px-4 py-6 border border-gray-500">
                <strong>{{ $service->name }}</strong>
                <div>{{ $service->darbi_item_number }}</div>
            </a>
        @endforeach
    </div>

</x-table-layout>