<x-table-layout heading="Services">
    <title>SERVICES PAGE</title>

    @fragment('modal')
        <div id="modal-container" onclick="toggleView('modal-container')"
            class="flex items-center justify-center hidden fixed top-0 left-0 w-full h-full bg-black/50 z-10">
            <div id="modal" onclick="event.stopPropagation()"
                class="relative px-4 py-6 sm:px-6 lg:px-8 w-1/2 max-w-[80%] rounded-lg bg-white shadow-sm z-20 overflow-y-auto max-h-[90vh]">
            </div>
        </div>
    @endfragment

    <div class="flex items-center">
        <a href="{{ route('services.create') }}"><x-ec-button
                hx-get="{{ route('services.create') }}" hx-target="#modal"
                hx-swap="innerHTML"
                onclick="toggleView('modal-container')">Create
                Service</x-ec-button></a>

        @if ($errors->service_create_errors->any())
            <p class="text-red-500 text-sm ml-3"> Error Creating Service</p>
        @endif
    </div>

    <br>

    <div class = "space-y-4">
        @foreach ($services as $service)
            @if ($service->active_status == 1)
                <a href="{{ route('services.show', $service) }}"
                    class="px-4 py-6 border border-gray-500 flex justify-between items-center"
                    hx-get="{{ route('services.show', $service) }}"
                    hx-target="#modal" hx-swap="innerHTML"
                    onclick="toggleView('modal-container')">
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

    <br>

    <x-ec-button onclick="toggleView('retired_services')">Retired
        Services</x-ec-button>

    <br>
    <br>

    <div id="retired_services" class = "space-y-4" class="hidden">
        @foreach ($services as $service)
            @if ($service->active_status == 0)
                <a href="{{ route('services.show', $service) }}"
                    class="block px-4 py-6 border border-gray-500"
                    hx-get="{{ route('services.show', $service) }}"
                    hx-target="#modal" hx-swap="innerHTML"
                    onclick="toggleView('modal-container')">
                    <strong>{{ $service->name }}</strong>
                    <div>ID: {{ $service->id }}</div>
                </a>
            @endif
        @endforeach
    </div>

</x-table-layout>
