<form {{ $attributes->merge(['method' => 'POST']) }}>
    @csrf
    {{ $slot }}

    <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">

            <x-form-box for="first_name"> First Name*
                <x-form-input type="text" name="first_name" id="first_name"
                    value="{{ $contact->first_name ?? old('first_name') }}"></x-form-input>
                @error('first_name')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

            <x-form-box for="last_name"> Last Name*
                <x-form-input type="text" name="last_name" id="last_name"
                    value="{{ $contact->last_name ?? old('last_name') }}"></x-form-input>
                @error('last_name')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

            <x-form-box for="email"> Email Address*
                <x-form-input type="email" name="email" id="email"
                    value="{{ $contact->email ?? old('email') }}"></x-form-input>
                @error('email')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

            <x-form-box for="phone_number"> Phone Number
                <x-form-input type="text" name="phone_number"
                    id="phone_number"
                    value="{{ $contact->phone_number ?? old('phone_number') }}"></x-form-input>
                @error('phone_number')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

            <x-form-box for="notes"> Notes
                <x-form-input type="text" name="notes" id="notes"
                    placeholder="Internal use notes about this contact (will not export to CSV)"
                    value="{{ $contact->notes ?? old('notes') }}"></x-form-input>
                @error('notes')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
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
