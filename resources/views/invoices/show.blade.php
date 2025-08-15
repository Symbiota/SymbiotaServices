<x-table-layout heading="Invoice: {{ $invoice->id }}">
    <title>Invoice: {{ $invoice->id }}</title>

    <ul>
        <li><b>Invoice ID:</b> {{ $invoice->id }}</li>
        <li><a href="/contracts/{{ $invoice->contract_id }}"><b>Contract ID:</b>
                {{ $invoice->contract_id }}</a></li>
        <li><b>Billing Start Date:</b> {{ $invoice->billing_start }}</li>
        <li><b>Billing End Date:</b> {{ $invoice->billing_end }}</li>
        <li><b>Total Amount Billed:</b> ${{ $invoice->amount_billed }}</li>
        <li><b>Date Invoiced:</b> {{ $invoice->date_invoiced }}</li>
        <li><b>Date Paid:</b> {{ $invoice->date_paid }}</li>
        <li><b>Notes:</b> {{ $invoice->notes }}</li>
    </ul>

    <br>

    <div class="flex items-start">
        <div class="flex items-center">
            <x-ec-button onclick="toggleView('edit-form')">Edit
                Invoice</x-ec-button>

            @if ($errors->any())
                <p class="text-red-500 text-sm ml-3"> Error Editing Invoice
                </p>
            @endif
        </div>
    </div>

    <script src="{{ asset('show-hide.js') }}"></script>

    <div id="edit-form" style="display:none;">
        <form method="POST">
            @csrf
            @method('PATCH')

            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">

                    <x-form-box for="contract_id"> Contract ID*
                        <x-form-input type="text" name="contract_id"
                            id="contract_id"
                            value="{{ old('contract_id') ?? ($contract->id ?? '') }}"></x-form-input>
                        @error('contract_id')
                            <p class="text-red-500 text-sm ml-3">
                                {{ $message }}
                            </p>
                        @enderror
                    </x-form-box>

                    <x-form-box for="billing_start"> Billing Start*
                        <x-form-input type="text" name="billing_start"
                            id="billing_start" placeholder="YYYY-MM-DD"
                            value="{{ old('billing_start') }}"></x-form-input>
                        @error('billing_start')
                            <p class="text-red-500 text-sm ml-3">
                                {{ $message }}
                            </p>
                        @enderror
                    </x-form-box>

                    <x-form-box for="billing_end"> Billing End*
                        <x-form-input type="text" name="billing_end"
                            id="billing_end" placeholder="YYYY-MM-DD"
                            value="{{ old('billing_end') }}"></x-form-input>
                        @error('billing_end')
                            <p class="text-red-500 text-sm ml-3">
                                {{ $message }}
                            </p>
                        @enderror
                    </x-form-box>

                    <x-form-box for="services"> Select Services*
                        <br>
                        @foreach ($services as $service)
                            <div class="p-4 border border-gray-500">
                                <input type="checkbox"
                                    name="service[{{ $service->id }}]"
                                    id="service" value="{{ $service->id }}"
                                    onchange="calc_total_amount_billed();">
                                {{ $service->name }}
                                <br>
                                <input type="number" value="1"
                                    min="1"
                                    name="qty[{{ $service->id }}]"
                                    id="qty_{{ $service->id }}"
                                    class="m-1 ml-4 mt-2 p-1 border border-gray-500"
                                    service_price="{{ $service->price_per_unit }}"
                                    onchange="calc_each_service_bill({{ $service->id }}); calc_total_amount_billed();">
                                $<input type="text"
                                    id="amount_owed_{{ $service->id }}"
                                    name="amount_owed[{{ $service->id }}]"
                                    value="{{ $service->price_per_unit }}"
                                    class="m-1 mt-2 p-1 border border-gray-500"
                                    readonly>
                            </div>
                        @endforeach
                        @error('services')
                            <p class="text-red-500 text-sm"> {{ $message }}
                            </p>
                        @enderror
                    </x-form-box>

                    <script>
                        function calc_each_service_bill(id) {
                            var qty_box = document.getElementById(
                                'qty_' + id)
                            var amount_owed_box = document.getElementById(
                                'amount_owed_' + id);
                            var price_per_unit = qty_box.getAttribute('service_price');
                            var qty = qty_box.value;
                            var amount_owed = price_per_unit * qty;
                            amount_owed_box.value = amount_owed.toFixed(
                                2);
                        }

                        function calc_total_amount_billed() {
                            var total_box = document.getElementById('amount_billed');
                            let total = 0;
                            const checkboxes = document.querySelectorAll(
                                '#service:checked');

                            checkboxes.forEach(checkbox => {
                                var amount_owed_box = document.getElementById(
                                    'amount_owed_' + checkbox.value)
                                total += parseFloat(amount_owed_box.value)
                            });

                            total_box.value = total.toFixed(2);
                        }
                    </script>

                    <x-form-box for="amount_billed"> Amount Billed*
                        <x-form-input type="text" name="amount_billed"
                            id="amount_billed"
                            value="{{ old('amount_billed') }}"></x-form-input>
                        @error('amount_billed')
                            <p class="text-red-500 text-sm ml-3">
                                {{ $message }}
                            </p>
                        @enderror
                    </x-form-box>

                    <x-form-box for="date_invoiced"> Date Invoiced
                        <x-form-input type="text" name="date_invoiced"
                            id="date_invoiced" placeholder="YYYY-MM-DD"
                            value="{{ old('date_invoiced') }}"></x-form-input>
                        @error('date_invoiced')
                            <p class="text-red-500 text-sm ml-3">
                                {{ $message }}
                            </p>
                        @enderror
                    </x-form-box>

                    <x-form-box for="date_paid"> Date Paid
                        <x-form-input type="text" name="date_paid"
                            id="date_paid" placeholder="YYYY-MM-DD"
                            value="{{ old('date_paid') }}"></x-form-input>
                        @error('date_paid')
                            <p class="text-red-500 text-sm ml-3">
                                {{ $message }}
                            </p>
                        @enderror
                    </x-form-box>

                    <x-form-box for="notes"> Notes
                        <x-form-input type="text" name="notes"
                            id="notes"
                            value="{{ old('notes') }}"></x-form-input>
                        @error('notes')
                            <p class="text-red-500 text-sm ml-3">
                                {{ $message }}
                            </p>
                        @enderror
                    </x-form-box>

                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <a href="/invoices/{{ $invoice->id ?? '' }}"
                    class="text-sm/6 font-semibold text-gray-900">Cancel</a>

                <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
            </div>
        </form>
    </div>

    <br>

    @foreach ($invoice->services as $service)
        <a href="/services/{{ $service->id }}">
            <ul class="block px-4 py-2 border border-gray-500">
                <li><b>
                        @if ($service->active_status == 0)
                            (RETIRED)
                        @endif
                    </b></li>
                <li><b>Service ID:</b> {{ $service->id }}</li>
                <li><b>Name:</b> {{ $service->name }}</li>
                <li><b>Quantity:</b> {{ $service->pivot->qty }}
                </li>
                <li><b>Amount Paid:</b> ${{ $service->pivot->amount_owed }}
                </li>
                <br>
                <li><b>Description:</b> {{ $service->description }}</li>
                <li><b>Price per unit:</b> ${{ $service->price_per_unit }}
                </li>
                <li><b>DARBI Item Number:</b>
                    {{ $service->darbi_item_number }}
                </li>
            </ul>
        </a>
        <br>
    @endforeach

</x-table-layout>
