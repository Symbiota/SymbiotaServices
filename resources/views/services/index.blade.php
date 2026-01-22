<x-table-layout heading="Services">
    <title>Services - SymbiotaServices</title>

    <div class="flex items-center">
        <x-ec-button href="{{ route('services.create') }}"
            hx-get="{{ route('services.create') }}" hx-target="#modal"
            hx-swap="innerHTML" onclick="toggleView('modal-container')">Create
            Service</x-ec-button>
    </div>

    <br>

    @fragment('service-list')
        <div id="service-list-div" hx-swap-oob="true">
            <div class="space-y-4">
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
            <x-ec-button class="!ml-0"
                onclick="toggleView('retired_services')">Retired
                Services</x-ec-button>
            <br><br>

            <div id="retired_services" class="space-y-4 hidden">
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
        </div>
    @endfragment

</x-table-layout>
