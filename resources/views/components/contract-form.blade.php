<form {{ $attributes->merge(['method' => 'POST']) }}>
    @csrf
    {{ $slot }}

    <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">

            <x-form-box for="customer_id"> Customer ID*
                <x-form-input type="text" name="customer_id" id="customer_id"
                    value="{{ $contract->customer_id ?? ($customer->id ?? old('customer_id')) }}"></x-form-input>
                @error('customer_id')
                    <p class="text-red-500 text-sm ml-3">
                        {{ $message }}</p>
                @enderror
            </x-form-box>

            <x-form-box for="original_contact_id"> Original Contact
                ID*
                <x-form-input type="text" name="original_contact_id"
                    id="original_contact_id"
                    value="{{ $contract->original_contact_id ?? old('original_contact_id') }}"></x-form-input>
                @error('original_contact_id')
                    <p class="text-red-500 text-sm ml-3">
                        {{ $message }}</p>
                @enderror
            </x-form-box>

            <x-form-box for="darbi_header_ref_1"> DARBI Header Ref
                1*
                <x-form-input type="text" name="darbi_header_ref_1"
                    id="darbi_header_ref_1"
                    value="{{ $contract->darbi_header_ref_1 ?? old('darbi_header_ref_1') }}"></x-form-input>
                @error('darbi_header_ref_1')
                    <p class="text-red-500 text-sm ml-3">
                        {{ $message }}</p>
                @enderror
            </x-form-box>

            <x-form-box for="darbi_header_ref_2"> DARBI Header Ref 2
                <x-form-input type="text" name="darbi_header_ref_2"
                    id="darbi_header_ref_2"
                    value="{{ $contract->darbi_header_ref_2 ?? old('darbi_header_ref_2') }}"></x-form-input>
                @error('darbi_header_ref_2')
                    <p class="text-red-500 text-sm ml-3">
                        {{ $message }}</p>
                @enderror
            </x-form-box>

            <x-form-box for="darbi_special_instructions"> DARBI
                Special
                Instructions
                <x-form-input type="text" name="darbi_special_instructions"
                    id="darbi_special_instructions"
                    value="{{ $contract->darbi_special_instructions ?? old('darbi_special_instructions') }}"></x-form-input>
                @error('darbi_special_instructions')
                    <p class="text-red-500 text-sm ml-3">
                        {{ $message }}</p>
                @enderror
            </x-form-box>

            <x-form-box for="notes"> Notes
                <x-form-input type="text" name="notes" id="notes"
                    value="{{ $contract->notes ?? old('notes') }}"></x-form-input>
                @error('notes')
                    <p class="text-red-500 text-sm ml-3">
                        {{ $message }}</p>
                @enderror
            </x-form-box>

        </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
        <a @if (isset($customer)) href="/customers/{{ $customer->id }}"
        @elseif (isset($contract)) href=""
        @else href="/contracts" @endif
            class="text-sm/6 font-semibold text-gray-900">Cancel</a>

        <button type="submit"
            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
    </div>
</form>
