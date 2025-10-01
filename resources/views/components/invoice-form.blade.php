<form {{ $attributes->merge(['method' => 'POST']) }}>
    @csrf
    {{ $slot }}

    <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">

            <x-form-box for="contract_id"> Contract ID*
                <x-form-input type="text" name="contract_id" id="contract_id"
                    value="{{ $invoice->contract_id ?? ($contract->id ?? old('contract_id')) }}"></x-form-input>
                @error('contract_id')
                    <p class="text-red-500 text-sm ml-3">
                        {{ $message }}
                    </p>
                @enderror
            </x-form-box>

            <x-form-box for="financial_contact_id"> Financial Contact ID*
                <x-form-input type="select" name="financial_contact_id"
                    id="financial_contact_id">
                    @isset($invoice)
                        // On invoice edit page
                        <option value="{{ $invoice->financial_contact_id }}">
                            {{ $invoice->financial_contact->last_name }},
                            {{ $invoice->financial_contact->first_name }}
                            - {{ $invoice->financial_contact_id }}
                        </option>
                    @endisset
                    @isset($contract->current_financial_contact_id)
                        // From contract view to invoice creation, autofill
                        current financial contact
                        <option
                            value="{{ $contract->current_financial_contact_id }}">
                            {{ $contract->current_financial_contact->last_name }},
                            {{ $contract->current_financial_contact->first_name }}
                            - {{ $contract->current_financial_contact_id }}
                        </option>
                    @endisset
                    <option value=""></option>
                    @foreach ($contacts as $contact)
                        <option value="{{ $contact->id }}">
                            {{ $contact->last_name }},
                            {{ $contact->first_name }} -
                            {{ $contact->id }}
                        </option>
                    @endforeach
                </x-form-input>
                @error('financial_contact_id')
                    <p class="text-red-500 text-sm ml-3">
                        {{ $message }}
                    </p>
                @enderror
            </x-form-box>

            <x-form-box for="billing_start"> Billing Start*
                <x-form-input type="text" name="billing_start"
                    id="billing_start" placeholder="YYYY-MM-DD"
                    value="{{ $invoice->billing_start ?? old('billing_start') }}"></x-form-input>
                @error('billing_start')
                    <p class="text-red-500 text-sm ml-3">
                        {{ $message }}
                    </p>
                @enderror
            </x-form-box>

            <x-form-box for="billing_end"> Billing End*
                <x-form-input type="text" name="billing_end" id="billing_end"
                    placeholder="YYYY-MM-DD"
                    value="{{ $invoice->billing_end ?? old('billing_end') }}"></x-form-input>
                @error('billing_end')
                    <p class="text-red-500 text-sm ml-3">
                        {{ $message }}
                    </p>
                @enderror
            </x-form-box>

            <x-form-box for="services_field">
                <div class="flex items-center">Select Services*
                    @error('services')
                        <p class="text-red-500 text-sm ml-6"> {{ $message }}
                        </p>
                    @enderror
                </div>
                @foreach ($services as $service)
                    <div class="p-4 border border-gray-500">
                        <input type="checkbox"
                            name="services[{{ $service->id }}]" id="service"
                            value="{{ $service->id }}"
                            onchange="calc_total_amount_billed();"
                            @if (isset($invoice)) {{ $invoice->services->find($service) ? 'checked' : '' }}
                            @else
                            {{ in_array($service->id, old('services', [])) ? 'checked' : '' }} @endif>
                        {{ $service->name }}
                        <br>
                        <input type="number"
                            @if (isset($invoice)) value="{{ $invoice->services->find($service)->pivot->qty ?? 1 }}"
                            @else
                                value="{{ old('qty.' . $service->id, 1) }}" @endif
                            step="any" min="0"
                            name="qty[{{ $service->id }}]"
                            id="qty_{{ $service->id }}"
                            class="m-1 ml-4 mt-2 p-1 border border-gray-500"
                            service_price="{{ $service->price_per_unit }}"
                            onchange="calc_each_service_bill(); calc_total_amount_billed();">
                        $<input type="text"
                            id="amount_owed_{{ $service->id }}"
                            name="amount_owed[{{ $service->id }}]"
                            value="{{ $service->price_per_unit }}"
                            class="m-1 mt-2 p-1 border border-gray-500"
                            readonly>
                    </div>
                @endforeach
            </x-form-box>

            <x-form-box for="amount_billed"> Amount Billed*
                <x-form-input type="text" name="amount_billed"
                    id="amount_billed" value="" readonly></x-form-input>
                @error('amount_billed')
                    <p class="text-red-500 text-sm ml-3">
                        {{ $message }}
                    </p>
                @enderror
            </x-form-box>

            <x-form-box for="date_invoiced"> Date Invoiced
                <x-form-input type="text" name="date_invoiced"
                    id="date_invoiced" placeholder="YYYY-MM-DD"
                    value="{{ $invoice->date_invoiced ?? old('date_invoiced') }}"></x-form-input>
                @error('date_invoiced')
                    <p class="text-red-500 text-sm ml-3">
                        {{ $message }}
                    </p>
                @enderror
            </x-form-box>

            <x-form-box for="date_paid"> Date Paid
                <x-form-input type="text" name="date_paid" id="date_paid"
                    placeholder="YYYY-MM-DD"
                    value="{{ $invoice->date_paid ?? old('date_paid') }}"></x-form-input>
                @error('date_paid')
                    <p class="text-red-500 text-sm ml-3">
                        {{ $message }}
                    </p>
                @enderror
            </x-form-box>

            <x-form-box for="notes"> Notes
                <x-form-input type="text" name="notes" id="notes"
                    value="{{ $invoice->notes ?? old('notes') }}"></x-form-input>
                @error('notes')
                    <p class="text-red-500 text-sm ml-3">
                        {{ $message }}
                    </p>
                @enderror
            </x-form-box>

        </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
        <a @if (request()->is('invoices/create/*')) href="{{ route('contracts.show', $contract) }}"
        @elseif (isset($invoice)) href="{{ route('invoices.show', $invoice) }}"
        @else href="{{ route('invoices.index') }}" @endif
            class="text-sm/6 font-semibold text-gray-900">Cancel</a>

        <button type="submit"
            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
    </div>

    <script src="{{ asset('js/invoice-cost-calculator.js') }}"></script>
</form>
