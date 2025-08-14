<x-table-layout heading="Contract: {{ $contract->id }}">
    <title>Contract: {{ $contract->id }}</title>

    <ul>
        <li><b>Contract ID:</b> {{ $contract->id }}</li>
        <li><a href="/customers/{{ $contract->customer_id }}"><b>Customer
                    ID:</b>
                {{ $contract->customer_id }}</a></li>
        <li><b>Original Contact ID:</b> {{ $contract->original_contact_id }}
        </li>
        <li><b>DARBI Header Ref 1:</b> {{ $contract->darbi_header_ref_1 }}
        </li>
        <li><b>DARBI Header Ref 2:</b> {{ $contract->darbi_header_ref_2 }}
        </li>
        <li><b>DARBI Special Instructions:</b>
            {{ $contract->darbi_special_instructions }}</li>
        <li><b>Notes:</b> {{ $contract->notes }}</li>
    </ul>

    <br>

    <div class="flex items-start">

        <div class="flex items-start">
            <x-ec-button onclick="toggleView('edit-form')">Edit
                Contract</x-ec-button>

            @if ($errors->any())
                <p class="text-red-500 text-sm ml-3"> Error Editing Contract
                </p>
            @endif
        </div>

        <x-ec-button onclick="toggleView('delete-form')">Delete
            Contract</x-ec-button>

        <div id="delete-form" style="display:none;" class="ml-6">
            <form method="POST" action="/contracts/{{ $contract->id }}">
                @csrf
                @method('DELETE')
                <p class="ml-6 mb-2">Are you sure?</p>
                <x-ec-button type="submit" class="hover:text-red-500">
                    YES</x-ec-button>
                <x-ec-button type="button" onclick="toggleView('delete-form')"
                    class="hover:text-red-500">
                    No</x-ec-button>
            </form>
        </div>

        <a href="/invoices/create"> <x-ec-button>Create
                Invoice</x-ec-button></a>

    </div>

    <script src="{{ asset('show-hide.js') }}"></script>

    <div id="edit-form" style="display:none;">
        <form method="POST">
            @csrf
            @method('PATCH')

            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">

                    <x-form-box for="customer_id"> Customer ID*
                        <x-form-input type="text" name="customer_id"
                            id="customer_id"
                            value="{{ $contract->customer_id ?? '' }}"></x-form-input>
                        @error('customer_id')
                            <p class="text-red-500 text-sm ml-3">
                                {{ $message }}</p>
                        @enderror
                    </x-form-box>

                    <x-form-box for="original_contact_id"> Original Contact
                        ID*
                        <x-form-input type="text" name="original_contact_id"
                            id="original_contact_id"
                            value="{{ $contract->original_contact_id ?? '' }}"></x-form-input>
                        @error('original_contact_id')
                            <p class="text-red-500 text-sm ml-3">
                                {{ $message }}</p>
                        @enderror
                    </x-form-box>

                    <x-form-box for="darbi_header_ref_1"> DARBI Header Ref
                        1*
                        <x-form-input type="text" name="darbi_header_ref_1"
                            id="darbi_header_ref_1"
                            value="{{ $contract->darbi_header_ref_1 ?? '' }}"></x-form-input>
                        @error('darbi_header_ref_1')
                            <p class="text-red-500 text-sm ml-3">
                                {{ $message }}</p>
                        @enderror
                    </x-form-box>

                    <x-form-box for="darbi_header_ref_2"> DARBI Header Ref 2
                        <x-form-input type="text" name="darbi_header_ref_2"
                            id="darbi_header_ref_2"
                            value="{{ $contract->darbi_header_ref_2 ?? '' }}"></x-form-input>
                        @error('darbi_header_ref_2')
                            <p class="text-red-500 text-sm ml-3">
                                {{ $message }}</p>
                        @enderror
                    </x-form-box>

                    <x-form-box for="darbi_special_instructions"> DARBI
                        Special
                        Instructions
                        <x-form-input type="text"
                            name="darbi_special_instructions"
                            id="darbi_special_instructions"
                            value="{{ $contract->darbi_special_instructions ?? '' }}"></x-form-input>
                        @error('darbi_special_instructions')
                            <p class="text-red-500 text-sm ml-3">
                                {{ $message }}</p>
                        @enderror
                    </x-form-box>

                    <x-form-box for="notes"> Notes
                        <x-form-input type="text" name="notes"
                            id="notes"
                            value="{{ $contract->notes ?? '' }}"></x-form-input>
                        @error('notes')
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

    @foreach ($contract->invoices as $invoice)
        <a href="/invoices/{{ $invoice->id }}">
            <ul class="block px-4 py-2 border border-gray-500">
                <li><b>Invoice ID:</b> {{ $invoice->id }}</li>
                <li><b>Contract ID:</b> {{ $invoice->contract_id }}
                </li>
                <li><b>Billing Start Date:</b>
                    {{ $invoice->billing_start }}
                </li>
                <li><b>Billing End Date:</b>
                    {{ $invoice->billing_end }}
                </li>
                <li><b>Amount Billed:</b> {{ $invoice->amount_billed }}
                </li>
                <li><b>Date Invoiced:</b> {{ $invoice->date_invoiced }}
                </li>
                <li><b>Date Paid:</b> {{ $invoice->date_paid }}</li>
                <li><b>Notes:</b> {{ $invoice->notes }}</li>
                <b>Services:</b>
                @foreach ($invoice->services as $service)
                    <p class="ml-8">
                        {{ $service->name }}: {{ $service->pivot->qty }}
                    </p>
                @endforeach
            </ul>
        </a>
    @endforeach

</x-table-layout>
