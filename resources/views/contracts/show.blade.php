<x-table-layout heading="Contract: {{ $contract->id }}">
    <title>Contract: {{ $contract->id }}</title>

    <ul>
        <li><b>Contract ID:</b> {{ $contract->id }}</li>
        <li><a href="/customers/{{ $contract->customer_id }}"><b>Customer ID:</b>
                {{ $contract->customer_id }}</a></li>
        <li><b>Original Contact ID:</b> {{ $contract->original_contact_id }}
        </li>
        <li><b>DARBI Header Ref 1:</b> {{ $contract->darbi_header_ref_1 }}</li>
        <li><b>DARBI Header Ref 2:</b> {{ $contract->darbi_header_ref_2 }}</li>
        <li><b>DARBI Special Instructions:</b>
            {{ $contract->darbi_special_instructions }}</li>
        <li><b>Notes:</b> {{ $contract->notes }}</li>
        <li><b>Start Date:</b> {{ $contract->start_date }}</li>
        <li><b>End Date:</b> {{ $contract->end_date }}</li>
    </ul>

    <br>

    <div class="flex items-center">
        <x-ec-button onclick="toggleEditForm()">Edit Contract</x-ec-button>

        @if ($errors->any())
            <p class="text-red-500 text-sm ml-3"> Error Editing Contract</p>
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
        <form method="POST">
            @csrf
            @method('PATCH')

            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">

                    <x-form-box for="customer_id"> Customer ID*
                        <x-form-input type="text" name="customer_id"
                            id="customer_id"
                            value="{{ $customer->id ?? '' }}"></x-form-input>
                        @error('customer_id')
                            <p class="text-red-500 text-sm ml-3">
                                {{ $message }}</p>
                        @enderror
                    </x-form-box>

                    <x-form-box for="original_contact_id"> Original Contact ID*
                        <x-form-input type="text" name="original_contact_id"
                            id="original_contact_id"></x-form-input>
                        @error('original_contact_id')
                            <p class="text-red-500 text-sm ml-3">
                                {{ $message }}</p>
                        @enderror
                    </x-form-box>

                    <x-form-box for="darbi_header_ref_1"> DARBI Header Ref 1*
                        <x-form-input type="text" name="darbi_header_ref_1"
                            id="darbi_header_ref_1"></x-form-input>
                        @error('darbi_header_ref_1')
                            <p class="text-red-500 text-sm ml-3">
                                {{ $message }}</p>
                        @enderror
                    </x-form-box>

                    <x-form-box for="darbi_header_ref_2"> DARBI Header Ref 2
                        <x-form-input type="text" name="darbi_header_ref_2"
                            id="darbi_header_ref_2"></x-form-input>
                        @error('darbi_header_ref_2')
                            <p class="text-red-500 text-sm ml-3">
                                {{ $message }}</p>
                        @enderror
                    </x-form-box>

                    <x-form-box for="darbi_special_instructions"> DARBI Special
                        Instructions
                        <x-form-input type="text"
                            name="darbi_special_instructions"
                            id="darbi_special_instructions"></x-form-input>
                        @error('darbi_special_instructions')
                            <p class="text-red-500 text-sm ml-3">
                                {{ $message }}</p>
                        @enderror
                    </x-form-box>

                    <x-form-box for="notes"> Notes
                        <x-form-input type="text" name="notes"
                            id="notes"></x-form-input>
                        @error('notes')
                            <p class="text-red-500 text-sm ml-3">
                                {{ $message }}</p>
                        @enderror
                    </x-form-box>

                    <x-form-box for="start_date"> Start Date*
                        <x-form-input type="text" name="start_date"
                            id="start_date"
                            placeholder="YYYY-MM-DD"></x-form-input>
                        @error('start_date')
                            <p class="text-red-500 text-sm ml-3">
                                {{ $message }}</p>
                        @enderror
                    </x-form-box>

                    <x-form-box for="end_date"> End Date*
                        <x-form-input type="text" name="end_date"
                            id="end_date"
                            placeholder="YYYY-MM-DD"></x-form-input>
                        @error('end_date')
                            <p class="text-red-500 text-sm ml-3">
                                {{ $message }}</p>
                        @enderror
                    </x-form-box>

                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <a href=""
                    class="text-sm/6 font-semibold text-gray-900">Cancel</a>

                <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
            </div>
        </form>
    </div>

    <br>
    <br>

    <div>
        @foreach ($contract->services as $service)
            <a href="/services/{{ $service->id }}">
                <ul class="block px-4 py-2 border border-gray-500">
                    <li><b>Service ID:</b> {{ $service->id }}</li>
                    <li><b>Service Name:</b> {{ $service->name }}</li>
                    <li><b>Description:</b> {{ $service->description }}</li>
                    <li><b>Price per unit:</b> {{ $service->price_per_unit }}
                    </li>
                    <li><b>DARBI Item Number:</b>
                        {{ $service->darbi_item_number }}</li>
                </ul>
            </a>
            <br>
        @endforeach
    </div>

</x-table-layout>
