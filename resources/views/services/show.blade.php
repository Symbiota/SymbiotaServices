<x-table-layout heading="{{ $service->name }}">
    @fragment('show-service')
        <title>Service: {{ $service->name }} - SymbiotaServices</title>

        <x-modal-header :isHTMX="$isHTMX">{{ $service->name }}
        </x-modal-header>
        <ul>
            <li><b>Name:</b> {{ $service->name }}</li>
            <li><b>DARBI Item Number:</b> {{ $service->darbi_item_number }}</li>
            <li><b>Price per Unit:</b> {{ $service->price_per_unit }}</li>
            <li><b>Description:</b> {{ $service->description }}</li>
            <x-timestamps :model="$service"></x-timestamps>
        </ul>

        <br>

        <div class="flex items-start">
            <div class="flex items-center">
                <x-ec-button onclick="toggleView('edit-form')">Edit
                    Service</x-ec-button>

                @if ($errors->any())
                    <p class="text-red-500 text-sm mr-3">Error Editing Service</p>
                @endif
            </div>

            <form method="POST" action="{{ route('services.retire', $service) }}">
                @csrf
                @method('PATCH')
                @if ($service->active_status)
                    <x-ec-button onclick="return confirm('Retire this service?');"
                        class="!border-red-500 !text-red-500">Retire
                        Service</x-ec-button>
                @else
                    <x-ec-button
                        onclick="return confirm('Unretire this service?');">Unretire
                        Service</x-ec-button>
                @endif
            </form>

            <x-ec-button onclick="toggleView('update-history')">View
                History</x-ec-button>
        </div>

        <div id="update-history" class="hidden">
            @foreach ($service->history() as $historyItem)
                <br>
                <ul>
                    @isset($historyItem->name)
                        <li><b>Name:</b> {{ $historyItem->name }}</li>
                    @endisset
                    @isset($historyItem->darbi_item_number)
                        <li><b>DARBI Item Number:</b>
                            {{ $historyItem->darbi_item_number }}
                        </li>
                    @endisset
                    @isset($historyItem->price_per_unit)
                        <li><b>Price per Unit:</b> {{ $historyItem->price_per_unit }}
                        </li>
                    @endisset
                    @isset($historyItem->description)
                        <li><b>Description:</b> {{ $historyItem->description }}</li>
                    @endisset
                    @isset($historyItem->active_status)
                        <li><b>Status:</b>
                            {{ $historyItem->active_status ? 'Active' : 'Retired' }}
                        </li>
                    @endisset
                    @if ($loop->index == 0)
                        <li class="mt-1 text-sm italic">Date Created:
                            {{ $historyItem->created_at }}</li>
                    @else
                        <li class="mt-1 text-sm italic">Date Updated:
                            {{ $historyItem->updated_at }}</li>
                    @endif
                    <li class="mt-1 text-sm italic">Modified By:
                        {{ \App\Models\User::find($historyItem->modified_by)->name ?? 'unknown' }}
                    </li>
                </ul>
            @endforeach
        </div>

        <div id="edit-form" class="{{ $errors->any() ? '' : 'hidden' }}">
            @if ($isHTMX)
                <x-service-form class="-mt-2" :errors="$errors" :service="$service"
                    hx-post="{{ route('services.update', $service) }}"
                    hx-target="#modal"
                    hx-swap="innerHTML scroll:top">@method('PATCH')</x-service-form>
            @else
                <x-service-form :service="$service"
                    action="{{ route('services.update', $service) }}">@method('PATCH')</x-service-form>
            @endif
        </div>
    @endfragment

</x-table-layout>
