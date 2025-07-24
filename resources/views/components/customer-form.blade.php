@props(['formMethod', 'formEndpoint', 'customer'])

@php
    $htmxMethodAttribute = match ($formMethod) {
        'POST' => "hx-post=\"{$formEndpoint}\"",
        'PATCH' => "hx-patch=\"{$formEndpoint}\"",
        default => '',
    };
@endphp
<!doctype html>

<form id="customer-create-form" {!! $htmxMethodAttribute !!}
    hx-target="#customer-list-div" hx-swap="outerHTML" x-show = "show">
    @csrf

    <div class="space-y-12" x-show="show">
        <div class="border-b border-gray-900/10 pb-12">

            <x-form-box for="name"> Name*
                <x-form-input type="text" name="name" id="name" placeholder="Hollis Stacy" value="{{ $customer->name ?? '' }}"></x-form-input>
                    @error('name')
                        <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                    @enderror
            </x-form-box>

            <x-form-box for="darbi_customer_account_number"> Darbi Customer Account Number*
                <x-form-input type="text" name="darbi_customer_account_number" id="darbi_customer_account_number" placeholder="1234" value="{{ $customer->darbi_customer_account_number ?? '' }}"></x-form-input>
                    @error('darbi_customer_account_number')
                        <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                    @enderror
            </x-form-box>

            <x-form-box for="darbi_site"> Darbi Site*
                <x-form-input type="text" name="darbi_site" id="darbi_site" placeholder="Site.com" value="{{ $customer->darbi_site ?? '' }}"></x-form-input>
                    @error('darbi_site')
                        <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                    @enderror
            </x-form-box>

            <x-form-box for="correspondence"> Correspondence
                <x-form-input type="text" name="correspondence" id="correspondence" placeholder="email@email.com" value="{{ $customer->correspondence ?? '' }}"></x-form-input>
                    @error('correspondence')
                        <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                    @enderror
            </x-form-box>

            <x-form-box for="notes"> Notes
                <x-form-input type="text" name="notes" id="notes" placeholder="Extra Notes" value="{{ $customer->notes ?? '' }}"></x-form-input>
                    @error('notes')
                        <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                    @enderror
            </x-form-box>

        </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
        <button type="button"
            @click="show = false;
            const el = document.getElementById('error-list');
            if (el) { el.replaceChildren(); }"
            class="text-sm/6
            font-semibold text-gray-900">Cancel</button>
        <button type="submit"
            @click="const el = document.getElementById('error-list');
            if (el) { el.replaceChildren(); }"
            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
    </div>
</form>
