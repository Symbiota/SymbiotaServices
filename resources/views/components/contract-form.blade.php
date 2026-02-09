<form {{ $attributes->merge(['method' => 'POST']) }}>
    @csrf
    {{ $slot }}

    <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">

            <x-form-box for="customer_id"> Customer Name*
                <x-form-input list="customer-datalist" name="customer_id"
                    id="customer_id"
                    value="{{ $contract->customer->name ?? ($customer->name ?? old('customer_id')) }}">
                </x-form-input>
                <datalist id="customer-datalist">
                    @foreach ($customers as $o_customer)
                        <option value="{{ $o_customer->name }}">
                            {{ $o_customer->name }}</option>
                    @endforeach
                </datalist>
                @error('customer_id')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

            @fragment('contract-contact-input')
                <datalist id="contact-datalist" hx-swap-oob="true">
                    @foreach ($contacts as $contact)
                        <option
                            value="{{ $contact->last_name }}, {{ $contact->first_name }} - {{ $contact->id }}">
                            {{ $contact->last_name }},
                            {{ $contact->first_name }} -
                            {{ $contact->id }}</option>
                    @endforeach
                </datalist>
            @endfragment

            <x-form-box for="financial_contact_id"> Financial Contact*
                <x-form-input list="contact-datalist"
                    name="financial_contact_id" id="financial_contact_id"
                    value="{{ $contract->current_financial_contact->full_name ?? old('financial_contact_id') }}">
                </x-form-input>
                @error('financial_contact_id')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

            <x-form-box for="pi_contact_id"> PI Contact
                <x-form-input list="contact-datalist" name="pi_contact_id"
                    id="pi_contact_id"
                    value="{{ $contract->pi_contact->full_name ?? old('pi_contact_id') }}">>
                </x-form-input>
                @error('pi_contact_id')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

            <x-form-box for="technical_contact_id"> SSH Internal Contact
                <x-form-input list="contact-datalist"
                    name="technical_contact_id" id="technical_contact_id"
                    value="{{ $contract->technical_contact->full_name ?? old('technical_contact_id') }}">>
                </x-form-input>
                @error('technical_contact_id')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

            <x-form-box for="darbi_header_ref_1"> DARBI Header Ref 1
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

        <x-cancel-button>
            @if (request()->routeIs('contracts.edit'))
                {{ route('contracts.show', $contract) }}
            @elseif (request()->routeIs('contracts.create') && !empty($customer->id))
                {{ route('customers.show', $customer) }}
            @elseif (request()->routeIs('contracts.create'))
                {{ route('contracts.index') }}
            @endif
        </x-cancel-button>

        <button type="submit"
            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
    </div>
</form>
