<x-table-layout heading="Customers">
    <title>CUSTOMERS PAGE</title>

    <button onclick="toggleCreateForm()" class='relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300'>Create Customer</button>

    @if ($errors->any())
        <p class="text-red-500">Error Creating Customer</p>
    @endif

    <div id="create-form" style="display:none;">
        <x-customer-form></x-customer-form>
    </div>

    <br>
    <br>
        
    <div class = "space-y-4">
        @foreach ($customers as $customer)
            <a href="/customers/{{ $customer->id }}" class="block px-4 py-6 border border-gray-500">
                <strong>{{ $customer->name }}</strong>
                <div>{{ $customer->darbi_account }}: {{ $customer->correspondence }}</div>
            </a>
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
    </script>



</x-table-layout>