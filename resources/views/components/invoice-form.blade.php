<form {{ $attributes->merge(['method' => 'POST']) }}>
    @csrf
    {{ $slot }}

    <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">

            <x-form-box for="contract_id"> Contract ID*
                <x-form-input type="select" name="contract_id" id="contract_id">
                    @isset($invoice->contract_id)
                        <option value="{{ $invoice->contract_id }}">
                            {{ $invoice->contract->customer->name }}
                            - {{ $invoice->contract_id }}
                        </option>
                    @endisset
                    @isset($contract->customer->name)
                        <option value="{{ $contract->id }}">
                            {{ $contract->customer->name }}
                            - {{ $contract->id }}
                        </option>
                    @endisset
                    <option value=""></option>
                    @foreach ($contracts as $o_contract)
                        <option value="{{ $o_contract->id }}">
                            {{ $o_contract->customer->name }} -
                            {{ $o_contract->id }}
                        </option>
                    @endforeach
                </x-form-input>
                @error('contract_id')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

            <datalist id="contact-datalist">
                @foreach ($contacts as $contact)
                    <option
                        value="{{ $contact->last_name }}, {{ $contact->first_name }} - {{ $contact->id }}">
                        {{ $contact->last_name }}, {{ $contact->first_name }}
                        - {{ $contact->id }}</option>
                @endforeach
            </datalist>

            <x-form-box for="financial_contact_id"> Financial Contact ID*
                <x-form-input list="contact-datalist"
                    name="financial_contact_id" id="financial_contact_id"
                    value="{{ $invoice->financial_contact->full_name ?? ($contract->current_financial_contact->full_name ?? old('financial_contact_id')) }}">
                </x-form-input>
                @error('financial_contact_id')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

            <x-form-box for="billing_start"> Billing Start*
                <x-form-input type="text" name="billing_start"
                    id="billing_start" placeholder="YYYY-MM-DD"
                    value="{{ $invoice->billing_start ?? old('billing_start') }}"></x-form-input>
                @error('billing_start')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

            <x-form-box for="billing_end"> Billing End*
                <x-form-input type="text" name="billing_end" id="billing_end"
                    placeholder="YYYY-MM-DD"
                    value="{{ $invoice->billing_end ?? old('billing_end') }}"></x-form-input>
                @error('billing_end')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

            @php
                [$activeServices, $inactiveServices] = $services->partition(
                    fn($service) => $service->active_status,
                );
            @endphp

            <x-form-box for="services_field">
                <div class="flex items-center mb-2">Select Services*
                    @error('services')
                        <p class="text-red-500 text-sm ml-6">{{ $message }}
                        </p>
                    @enderror
                </div>
                @foreach ($activeServices as $service)
                    <div class="p-4 border border-gray-500">
                        <input type="checkbox"
                            name="services[{{ $service->id }}]" id="service"
                            value="{{ $service->id }}"
                            data-id="{{ $service->id }}"
                            onchange="calc_total_amount_billed();"
                            @if (!empty($invoice->id)) {{ $invoice->services->find($service) ? 'checked' : '' }}
                            @else {{ old('services.' . $service->id) ? 'checked' : '' }} @endif>
                        {{ $service->name }}
                        <br>
                        <input type="number"
                            class="m-1 ml-4 mt-2 p-1 border border-gray-500"
                            @if (!empty($invoice->id)) value="{{ $invoice->services->find($service)->pivot->qty ?? 1 }}"
                            @else value="{{ old('qty.' . $service->id, 1) }}" @endif
                            step="any" min="0"
                            name="qty[{{ $service->id }}]"
                            id="qty_{{ $service->id }}"
                            service_price="{{ $service->price_per_unit }}"
                            onchange="select_checkbox({{ $service->id }}); calc_each_service_bill(); calc_total_amount_billed();">
                        $<input type="text"
                            class="m-1 mt-2 p-1 border border-gray-500"
                            id="amount_owed_{{ $service->id }}"
                            name="amount_owed[{{ $service->id }}]"
                            value="{{ $service->price_per_unit }}" readonly>
                        <input type="text"
                            class="m-1 mt-2 p-1 border border-gray-500 ml-4"
                            name="line_ref_1[{{ $service->id }}]"
                            id="line_ref_1" placeholder="Line Ref 1"
                            @if (!empty($invoice->id)) value="{{ $invoice->services->find($service)->pivot->line_ref_1 ?? '' }}"
                            @else value="{{ old('line_ref_1.' . $service->id) }}" @endif>
                        <input type="text"
                            class="m-1 mt-2 p-1 border border-gray-500"
                            name="line_ref_2[{{ $service->id }}]"
                            id="line_ref_2" placeholder="Line Ref 2"
                            @if (!empty($invoice->id)) value="{{ $invoice->services->find($service)->pivot->line_ref_2 ?? '' }}"
                            @else value="{{ old('line_ref_2.' . $service->id) }}" @endif">
                    </div>
                @endforeach

                <br>
                <x-ec-button type="button" class="!ml-0"
                    onclick="toggleView('retired_services')">Retired
                    Services</x-ec-button>
                <br>

                <div id="retired_services" class="hidden">
                    <br>
                    @foreach ($inactiveServices as $service)
                        <div class="p-4 border border-gray-500">
                            <input type="checkbox"
                                name="services[{{ $service->id }}]"
                                id="service" value="{{ $service->id }}"
                                data-id="{{ $service->id }}"
                                onchange="calc_total_amount_billed();"
                                @if (!empty($invoice->id)) {{ $invoice->services->find($service) ? 'checked' : '' }}
                            @else {{ old('services.' . $service->id) ? 'checked' : '' }} @endif>
                            {{ $service->name }}
                            <br>
                            <input type="number"
                                class="m-1 ml-4 mt-2 p-1 border border-gray-500"
                                @if (!empty($invoice->id)) value="{{ $invoice->services->find($service)->pivot->qty ?? 1 }}"
                            @else value="{{ old('qty.' . $service->id, 1) }}" @endif
                                step="any" min="0"
                                name="qty[{{ $service->id }}]"
                                id="qty_{{ $service->id }}"
                                service_price="{{ $service->price_per_unit }}"
                                onchange="select_checkbox({{ $service->id }}); calc_each_service_bill(); calc_total_amount_billed();">
                            $<input type="text"
                                class="m-1 mt-2 p-1 border border-gray-500"
                                id="amount_owed_{{ $service->id }}"
                                name="amount_owed[{{ $service->id }}]"
                                value="{{ $service->price_per_unit }}"
                                readonly>
                            <input type="text"
                                class="m-1 mt-2 p-1 border border-gray-500 ml-4"
                                name="line_ref_1[{{ $service->id }}]"
                                id="line_ref_1" placeholder="Line Ref 1"
                                @if (!empty($invoice->id)) value="{{ $invoice->services->find($service)->pivot->line_ref_1 ?? '' }}"
                            @else value="{{ old('line_ref_1.' . $service->id) }}" @endif>
                            <input type="text"
                                class="m-1 mt-2 p-1 border border-gray-500"
                                name="line_ref_2[{{ $service->id }}]"
                                id="line_ref_2" placeholder="Line Ref 2"
                                @if (!empty($invoice->id)) value="{{ $invoice->services->find($service)->pivot->line_ref_2 ?? '' }}"
                            @else value="{{ old('line_ref_2.' . $service->id) }}" @endif">
                        </div>
                    @endforeach
                </div>
            </x-form-box>

            <x-form-box for="amount_billed"> Amount Billed*
                <x-form-input type="text" name="amount_billed"
                    id="amount_billed" value="" readonly></x-form-input>
                @error('amount_billed')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

            <x-form-box for="date_invoiced"> Date Invoiced
                <x-form-input type="text" name="date_invoiced"
                    id="date_invoiced" placeholder="YYYY-MM-DD"
                    value="{{ $invoice->date_invoiced ?? old('date_invoiced') }}"></x-form-input>
                @error('date_invoiced')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

            <x-form-box for="date_paid"> Date Paid
                <x-form-input type="text" name="date_paid" id="date_paid"
                    placeholder="YYYY-MM-DD"
                    value="{{ $invoice->date_paid ?? old('date_paid') }}"></x-form-input>
                @error('date_paid')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

            <x-form-box for="darbi_header_ref_1"> DARBI Header Ref 1
                <x-form-input type="text" name="darbi_header_ref_1"
                    id="darbi_header_ref_1"
                    placeholder="Portal name, e.g. &quot;CCH2 Symbiota Portal&quot; (20 character max)"
                    value="{{ $invoice->darbi_header_ref_1 ?? ($contract->darbi_header_ref_1 ?? old('darbi_header_ref_1')) }}"></x-form-input>
                @error('darbi_header_ref_1')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

            <x-form-box for="darbi_header_ref_2"> DARBI Header Ref 2
                <x-form-input type="text" name="darbi_header_ref_2"
                    id="darbi_header_ref_2"
                    placeholder="Optional additional description of service (20 characters max)"
                    value="{{ $invoice->darbi_header_ref_2 ?? ($contract->darbi_header_ref_2 ?? old('darbi_header_ref_2')) }}"></x-form-input>
                @error('darbi_header_ref_2')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

            <x-form-box for="notes"> Notes
                <x-form-input type="text" name="notes" id="notes"
                    value="{{ $invoice->notes ?? old('notes') }}"></x-form-input>
                @error('notes')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

        </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">

        <x-cancel-button>
            @if (request()->routeIs('invoices.edit'))
                {{ route('invoices.show', $invoice) }}
            @elseif (request()->routeIs('invoices.create') && !empty($contract->id))
                {{ route('contracts.show', $contract) }}
            @elseif (request()->routeIs('invoices.create'))
                {{ route('invoices.index') }}
            @endif
        </x-cancel-button>

        <button type="submit"
            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
    </div>

    <script src="{{ asset('js/invoice-cost-calculator.js') }}"></script>
</form>
