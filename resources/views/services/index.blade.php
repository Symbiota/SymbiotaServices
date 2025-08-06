<x-table-layout heading="Services">
    <title>SERVICES PAGE</title>

    <div class="flex items-center">
        <x-ec-button onclick="toggleCreateForm()">Create Service</x-ec-button>

        @if ($errors->any())
            <p class="text-red-500 text-sm ml-3"> Error Creating Service</p>
        @endif
    </div>

    <div id="create-form" style="display:none;">
        <x-service-form action="/services"></x-service-form>
    </div>

    <br>

    <div class = "space-y-4">
        @foreach ($services as $service)
            @if ($service->active_status == 1)
                <a href="/services/{{ $service->id }}"
                    class="block px-4 py-6 border border-gray-500 flex justify-between items-center">
                    <div>
                        <strong>{{ $service->name }}</strong>
                        <div>ID: {{ $service->id }}</div>
                        <div>Price Per Unit: {{ $service->price_per_unit }}
                        </div>
                    </div>
                    <form method="post"
                        action="/services/{{ $service->id }}/retire">
                        @csrf
                        @method('PATCH')
                        <x-ec-button>Retire</x-ec-button>
                    </form>
                </a>
            @endif
        @endforeach
    </div>

    <br>

    <x-ec-button onclick="toggleRetiredServices()">Retired
        Services</x-ec-button>

    <br>
    <br>

    <div id="retired_services" class = "space-y-4" style="display:none;">
        @foreach ($services as $service)
            @if ($service->active_status == 0)
                <a href="/services/{{ $service->id }}"
                    class="block px-4 py-6 border border-gray-500">
                    <strong>{{ $service->name }}</strong>
                    <div>ID: {{ $service->id }}</div>
                </a>
            @endif
        @endforeach
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

        function toggleRetiredServices() {
            var element = document.getElementById("retired_services");
            if (element.style.display === "none") {
                element.style.display = "block";
            } else {
                element.style.display = "none";
            }
        }
    </script>

</x-table-layout>
