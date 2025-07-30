<x-table-layout heading="Services">
    <title>SERVICES PAGE</title>

    <div class="flex items-center">
        <x-ec-button onclick="toggleCreateForm()">Create Service</x-ec-button>

        @if ($errors->any())
            <p class="text-red-500 text-sm ml-3"> Error Creating Service</p>
        @endif
    </div>

    <script>
        function toggleCreateForm() {
            var form = document.getElementById("create-form");
            if (form.style.display === "none") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }
    </script>

    <div id="create-form" style="display:none;">
        <x-service-form action="/services"></x-service-form>
    </div>

    <br>

    <div class = "space-y-4">
        @foreach ($services as $service)
            <a href="/services/{{ $service->id }}" class="block px-4 py-6 border border-gray-500">
                <strong>{{ $service->name }}</strong>
                <div>ID: {{ $service->id }}</div>
            </a>
        @endforeach
    </div>

</x-table-layout>