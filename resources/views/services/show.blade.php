<x-table-layout heading="{{ $service->name }}">
    <title>SERVICE: {{ $service->name }}</title>

    <ul>
        <li><b>Name:</b> {{ $service->name }}</li>
        <li><b>DARBI Item Number:</b> {{ $service->darbi_item_number }}</li>
        <li><b>Price per Unit:</b> {{ $service->price_per_unit }}</li>
        <li><b>Description:</b> {{ $service->description }}</li>
    </ul>

    <br>

    <div class="flex items-center">
        <x-ec-button onclick="toggleEditForm()">Edit Service</x-ec-button>

        @if ($errors->any())
            <p class="text-red-500 text-sm ml-3"> Error Editing Service</p>
        @endif
    </div>

    <script>
        function toggleEditForm() {
            var form = document.getElementById("edit-form");
            if (form.style.display === "none") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }
    </script>

    <div id="edit-form" style="display:none;">
        <x-service-form :service="$service">@method('PATCH')</x-service-form>
    </div>
    <br>

    <form method="post" action="/services/{{ $service->id }}/retire">
        @csrf
        @method('PATCH')
        <x-ec-button>Retire Service</x-ec-button>
    </form>

</x-table-layout>
