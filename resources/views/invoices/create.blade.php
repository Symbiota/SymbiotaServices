<x-table-layout heading="Create Invoice">
    <title>CREATE INVOICE</title>

    <form method="POST" action="/invoices/create">
        @csrf

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">

                <x-form-box for="contract_id" class="-mt-8"> Contract ID*
                    <x-form-input type="text" name="contract_id"
                        id="contract_id"
                        value="{{ old('contract_id') ?? ($contract->id ?? '') }}"></x-form-input>
                    @error('contract_id')
                        <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                    @enderror
                </x-form-box>

                <x-form-box for="billing_start"> Billing Start*
                    <x-form-input type="text" name="billing_start"
                        id="billing_start" placeholder="YYYY-MM-DD"
                        value="{{ old('billing_start') }}"></x-form-input>
                    @error('billing_start')
                        <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                    @enderror
                </x-form-box>

                <x-form-box for="billing_end"> Billing End*
                    <x-form-input type="text" name="billing_end"
                        id="billing_end" placeholder="YYYY-MM-DD"
                        value="{{ old('billing_end') }}"></x-form-input>
                    @error('billing_end')
                        <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                    @enderror
                </x-form-box>

                <x-form-box for="services"> Select Services*
                    <br>
                    @foreach ($services as $service)
                        <div class="p-4 border border-gray-500">
                            <input type="checkbox"
                                name="service[{{ $service->id }}]"
                                value="{{ $service->id }}">
                            {{ $service->name }}
                            <br>
                            <input type="number" id="qty"
                                name="qty[{{ $service->id }}]" value="1"
                                min="1"
                                class="m-1 ml-4 mt-2 p-1 border border-gray-500"
                                service_price="{{ $service->price_per_unit }}"
                                onchange="calc_amount_owed(this)">
                            $<input type="text" id="amount_owed"
                                name="amount_owed[{{ $service->id }}]"
                                value="{{ $service->price_per_unit }}"
                                class="m-1 mt-2 p-1 border border-gray-500"
                                readonly>
                        </div>
                    @endforeach
                    @error('services')
                        <p class="text-red-500 text-sm"> {{ $message }}</p>
                    @enderror
                </x-form-box>

                <script>
                    function calc_amount_owed(element) {
                        var price_per_unit = element.getAttribute('service_price');
                        var qty = element.value;
                        var amount_owed = price_per_unit * qty;
                        var amount_owed_box = element.parentElement.querySelector(
                            '#amount_owed');
                        amount_owed_box.value = amount_owed.toFixed(
                            2);
                    }
                </script>

                <x-form-box for="amount_billed"> Amount Billed*
                    <x-form-input type="text" name="amount_billed"
                        id="amount_billed"
                        value="{{ old('amount_billed') }}"></x-form-input>
                    @error('amount_billed')
                        <p class="text-red-500 text-sm ml-3">{{ $message }}
                        </p>
                    @enderror
                </x-form-box>

                <x-form-box for="date_invoiced"> Date Invoiced
                    <x-form-input type="text" name="date_invoiced"
                        id="date_invoiced" placeholder="YYYY-MM-DD"
                        value="{{ old('date_invoiced') }}"></x-form-input>
                    @error('date_invoiced')
                        <p class="text-red-500 text-sm ml-3">{{ $message }}
                        </p>
                    @enderror
                </x-form-box>

                <x-form-box for="date_paid"> Date Paid
                    <x-form-input type="text" name="date_paid" id="date_paid"
                        placeholder="YYYY-MM-DD"
                        value="{{ old('date_paid') }}"></x-form-input>
                    @error('date_paid')
                        <p class="text-red-500 text-sm ml-3">{{ $message }}
                        </p>
                    @enderror
                </x-form-box>

                <x-form-box for="notes"> Notes
                    <x-form-input type="text" name="notes" id="notes"
                        value="{{ old('notes') }}"></x-form-input>
                    @error('notes')
                        <p class="text-red-500 text-sm ml-3">{{ $message }}
                        </p>
                    @enderror
                </x-form-box>

            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="/contracts/{{ $contract->id ?? '' }}"
                class="text-sm/6 font-semibold text-gray-900">Cancel</a>

            <button type="submit"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
        </div>
    </form>

</x-table-layout>
