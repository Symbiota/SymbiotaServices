<x-table-layout heading="{{ $service->name }}">
    @fragment('solo-service')
        <title>SERVICE: {{ $service->name }}</title>

        <ul>
            <li><b>Name:</b> {{ $service->name }}</li>
            <li><b>DARBI Item Number:</b> {{ $service->darbi_item_number }}</li>
            <li><b>Price per Unit:</b> {{ $service->price_per_unit }}</li>
            <li><b>Description:</b> {{ $service->description }}</li>
            <li><b>Line Reference 1:</b> {{ $service->line_ref_1 }}</li>
            <li><b>Line Reference 2:</b> {{ $service->line_ref_2 }}</li>
            <x-timestamps :model="$service"></x-timestamps>
        </ul>

        <br>

        <div class="flex items-start">

            <div class="flex items-center">
                <x-ec-button onclick="toggleView('edit-form')">Edit
                    Service</x-ec-button>

                @if ($errors->any())
                    <p class="text-red-500 text-sm ml-3"> Error Editing Service</p>
                @endif
            </div>

            <form method="post" action="{{ route('services.retire', $service) }}">
                @csrf
                @method('PATCH')
                <x-ec-button onclick="return confirm('Retire this service?');"
                    class="!border-red-500 !text-red-500">Retire
                    Service</x-ec-button>
            </form>

        </div>

        <div id="edit-form" style="display:none;">
            <x-service-form :service="$service"
                action="{{ route('services.update', $service) }}">@method('PATCH')</x-service-form>
        </div>
        <br>
    @endfragment

</x-table-layout>
