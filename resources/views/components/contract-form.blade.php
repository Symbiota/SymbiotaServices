<form {{ $attributes->merge(['method' => 'POST']) }}>
    @csrf
    {{ $slot }}

    <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">

            <x-form-box for="customer_id"> Customer Name*
                <x-form-input type="type" list="customer-datalist"
                    name="customer_id" id="customer_id"
                    value="{{ $contract->customer->name ?? ($customer->name ?? old('customer_id')) }}">
                </x-form-input>
                <datalist id="customer-datalist">
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->name }}">
                            {{ $customer->name }}</option>
                    @endforeach
                </datalist>
                @error('customer_id')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

            <x-form-box for="financial_contact_id"> Financial Contact ID*
                <x-form-input type="select" name="financial_contact_id"
                    id="financial_contact_id">
                    @isset($contract->current_financial_contact_id)
                        // If on contract edit page, autofill contact id
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
                    <p class="text-red-500 text-sm ml-3">{{ $message }}
                    </p>
                @enderror
            </x-form-box>

            <x-form-box for="pi_contact_id"> PI Contact ID
                <x-form-input type="select" name="pi_contact_id"
                    id="pi_contact_id">
                    @isset($contract->pi_contact_id)
                        // If on contract edit page, autofill contact id
                        <option value="{{ $contract->pi_contact_id }}">
                            {{ $contract->pi_contact->last_name }},
                            {{ $contract->pi_contact->first_name }}
                            - {{ $contract->pi_contact_id }}
                        </option>
                    @endisset
                    <option value="" class=""></option>
                    @foreach ($contacts as $contact)
                        <option value="{{ $contact->id }}">
                            {{ $contact->last_name }},
                            {{ $contact->first_name }} -
                            {{ $contact->id }}
                        </option>
                    @endforeach
                </x-form-input>
                @error('pi_contact_id')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

            <x-form-box for="technical_contact_id"> Technical Contact ID
                <x-form-input type="select" name="technical_contact_id"
                    id="technical_contact_id">
                    @isset($contract->technical_contact_id)
                        // If on contract edit page, autofill contact id
                        <option value="{{ $contract->technical_contact_id }}">
                            {{ $contract->technical_contact->last_name }},
                            {{ $contract->technical_contact->first_name }}
                            - {{ $contract->technical_contact_id }}
                        </option>
                    @endisset
                    <option value="" class=""></option>
                    @foreach ($contacts as $contact)
                        <option value="{{ $contact->id }}">
                            {{ $contact->last_name }},
                            {{ $contact->first_name }} -
                            {{ $contact->id }}
                        </option>
                    @endforeach
                </x-form-input>
                @error('technical_contact_id')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

            <x-form-box for="darbi_header_ref_1"> DARBI Header Ref
                1*
                <x-form-input type="text" name="darbi_header_ref_1"
                    id="darbi_header_ref_1"
                    placeholder="Portal name, e.g. &quot;CCH2 Symbiota Portal&quot; (20 character max)"
                    value="{{ $contract->darbi_header_ref_1 ?? old('darbi_header_ref_1') }}"></x-form-input>
                @error('darbi_header_ref_1')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

            <x-form-box for="darbi_header_ref_2"> DARBI Header Ref 2
                <x-form-input type="text" name="darbi_header_ref_2"
                    id="darbi_header_ref_2"
                    placeholder="Optional additional description of service (20 characters max)"
                    value="{{ $contract->darbi_header_ref_2 ?? old('darbi_header_ref_2') }}"></x-form-input>
                @error('darbi_header_ref_2')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

            <x-form-box for="darbi_special_instructions"> DARBI Special
                Instructions
                <x-form-input type="text" name="darbi_special_instructions"
                    id="darbi_special_instructions"
                    placeholder="Corresponds to KU_Symbiota_Quote_NMNH_20250423c.pdf"
                    value="{{ $contract->darbi_special_instructions ?? old('darbi_special_instructions') }}"></x-form-input>
                @error('darbi_special_instructions')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

            <x-form-box for="notes"> Notes
                <x-form-input type="text" name="notes" id="notes"
                    placeholder="Notes to be included in the Customer Request CSV"
                    value="{{ $contract->notes ?? old('notes') }}"></x-form-input>
                @error('notes')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

        </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">

        <x-cancel-button></x-cancel-button>

        <button type="submit"
            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
    </div>
</form>
