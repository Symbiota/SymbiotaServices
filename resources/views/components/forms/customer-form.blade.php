@props([
    'customer' => null,
    'errors' => null,
])

<form {{ $attributes->merge(['method' => 'POST']) }}>
    @csrf
    {{ $slot }}

    <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">

            <x-form-box for="name"> Name*
                <x-form-input type="text" name="name" id="name"
                    placeholder="University of Kansas"
                    value="{{ old('name') ?? (request()->input('name') ?? $customer?->name) }}"></x-form-input>
                @error('name')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

            <x-form-box for="department_name"> Department Name
                <x-form-input type="text" name="department_name"
                    id="department_name"
                    placeholder="Department of Ecology and Evolutionary Biology "
                    value="{{ old('department_name') ?? (request()->input('department_name') ?? $customer?->department_name) }}"></x-form-input>
                @error('department_name')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

            <x-form-box for="darbi_customer_account_number"> DARBI Customer
                Account Number
                <x-form-input type="text"
                    name="darbi_customer_account_number"
                    id="darbi_customer_account_number" placeholder="1234"
                    value="{{ old('darbi_customer_account_number') ?? (request()->input('darbi_customer_account_number') ?? $customer?->darbi_customer_account_number) }}"></x-form-input>
                @error('darbi_customer_account_number')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

            <x-form-box for="darbi_site"> DARBI Site
                <x-form-input type="text" name="darbi_site" id="darbi_site"
                    placeholder="A1234"
                    value="{{ old('darbi_site') ?? (request()->input('darbi_site') ?? $customer?->darbi_site) }}"></x-form-input>
                @error('darbi_site')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

            <x-form-box for="address_line_1"> Address Line 1*
                <x-form-input type="text" name="address_line_1"
                    id="address_line_1" placeholder="1234 Main Street"
                    value="{{ old('address_line_1') ?? (request()->input('address_line_1') ?? $customer?->address_line_1) }}"></x-form-input>
                @error('address_line_1')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}
                    </p>
                @enderror
            </x-form-box>

            <x-form-box for="address_line_2"> Address Line 2
                <x-hint>E.g., building, suite, room, etc.</x-hint>
                <x-form-input type="text" name="address_line_2"
                    id="address_line_2"
                    value="{{ old('address_line_2') ?? (request()->input('address_line_2') ?? $customer?->address_line_2) }}"></x-form-input>
                @error('address_line_2')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}
                    </p>
                @enderror
            </x-form-box>

            <x-form-box for="city"> City*
                <x-form-input type="text" name="city" id="city"
                    placeholder=""
                    value="{{ old('city') ?? (request()->input('city') ?? $customer?->city) }}"></x-form-input>
                @error('city')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}
                    </p>
                @enderror
            </x-form-box>

            <x-form-box for="state"> State*
                <x-form-input type="text" name="state" id="state"
                    placeholder=""
                    value="{{ old('state') ?? (request()->input('state') ?? $customer?->state) }}"></x-form-input>
                @error('state')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}
                    </p>
                @enderror
            </x-form-box>

            <x-form-box for="zip_code"> Zip Code*
                <x-form-input type="text" name="zip_code" id="zip_code"
                    placeholder=""
                    value="{{ old('zip_code') ?? (request()->input('zip_code') ?? $customer?->zip_code) }}"></x-form-input>
                @error('zip_code')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}
                    </p>
                @enderror
            </x-form-box>

            <x-form-box for="country"> Country*
                <x-form-input type="text" name="country" id="country"
                    placeholder=""
                    value="{{ old('country') ?? (request()->input('country') ?? $customer?->country) }}"></x-form-input>
                @error('country')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}
                    </p>
                @enderror
            </x-form-box>

            <x-form-box for="notes"> Notes
                <x-hint>Extra notes to display in customer request CSV</x-hint>
                <x-form-input type="text" name="notes" id="notes"
                    value="{{ old('notes') ?? (request()->input('notes') ?? $customer?->notes) }}"></x-form-input>
                @error('notes')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}
                    </p>
                @enderror
            </x-form-box>

        </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">

        <x-cancel-button>
            @if (request()->routeIs('customers.edit'))
                {{ route('customers.show', $customer) }}
            @elseif (request()->routeIs('customers.create'))
                {{ route('customers.index') }}
            @endif
        </x-cancel-button>

        <button type="submit"
            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
    </div>
</form>
