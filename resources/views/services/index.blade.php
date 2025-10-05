<x-table-layout heading="Services">
    <title>SERVICES PAGE</title>

    <div class="flex items-center">
        <x-ec-button onclick="toggleView('create-form')">Create
            Service</x-ec-button>

        @if ($errors->any())
            <p class="text-red-500 text-sm ml-3"> Error Creating Service</p>
        @endif
    </div>

    <div id="create-form" style="display:none;">
        <x-service-form action="{{ route('services.store') }}"></x-service-form>
    </div>

    <br>

    <div class = "space-y-4">
        @foreach ($services as $service)
            @if ($service->active_status == 1)
                <a href="{{ route('services.show', $service) }}"
                    class="px-4 py-6 border border-gray-500 flex justify-between items-center"
                    hx-get="{{ route('services.show', $service) }}"
                    hx-target="#modal" hx-swap="innerHTML">
                    <div>
                        <strong>{{ $service->name }}</strong>
                        <div>ID: {{ $service->id }}</div>
                        <div>Price Per Unit: {{ $service->price_per_unit }}
                        </div>
                    </div>
                </a>
            @endif
        @endforeach
    </div>

    @fragment('modal')
        <div class="my-12 mx-auto p-12 bg-white rounded-sm max-w-200"
            id="modal"></div>
    @endfragment

    <br>

    <x-ec-button onclick="toggleView('retired_services')">Retired
        Services</x-ec-button>

    <br>
    <br>

    <div id="retired_services" class = "space-y-4" style="display:none;">
        @foreach ($services as $service)
            @if ($service->active_status == 0)
                <a href="{{ route('services.show', $service) }}"
                    class="block px-4 py-6 border border-gray-500">
                    <strong>{{ $service->name }}</strong>
                    <div>ID: {{ $service->id }}</div>
                </a>
            @endif
        @endforeach
    </div>

</x-table-layout>
