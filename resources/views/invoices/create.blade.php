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

                <x-form-box for="service"> Select Service* (Hold ctrl or cmd to
                    select multiple)
                    <div class="mt-2">
                        <div
                            class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                            <select name="services[]" id="services"
                                class="border" required multiple>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}">
                                        {{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('service')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </x-form-box>

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
            <a href="/customers/{{ $customer->id ?? '' }}"
                class="text-sm/6 font-semibold text-gray-900">Cancel</a>

            <button type="submit"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
        </div>
    </form>

</x-table-layout>
