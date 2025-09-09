<x-table-layout heading="Create Contract">
    <title>CREATE CONTRACT</title>

    <div class="flex items-start">
        <div class="w-4/5">
            <x-contract-form class="-mt-8" :customer="$customer" :contacts="$contacts"
                action="/contracts"></x-contract-form>
        </div>

        <div class="w-1/5">
            <div class="flex items-center">
                <x-ec-button onclick="toggleView('create-form')">Create
                    Contact</x-ec-button>

                @if ($errors->contact_errors->any())
                    <p class="text-red-500 text-sm ml-3"> Error Creating Contact
                    </p>
                @endif
            </div>

            <div id="create-form" style="display:none;">
                <x-contact-form action="/contacts/create"></x-contact-form>
            </div>

        </div>

</x-table-layout>
