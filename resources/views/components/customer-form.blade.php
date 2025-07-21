@props(['formMethod', 'formEndpoint', 'customer'])

@php
    $htmxMethodAttribute = match ($formMethod) {
        'POST' => "hx-post=\"{$formEndpoint}\"",
        'PATCH' => "hx-patch=\"{$formEndpoint}\"",
        default => '',
    };
@endphp
<!doctype html>

<form {!! $htmxMethodAttribute !!} hx-target="#customer-list-div" hx-swap="outerHTML"
    x-show = "show">
    @csrf

    {{ $slot }}

    <div class="space-y-12" x-show="show">
        <div class="border-b border-gray-900/10 pb-12">

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-4">
                    <label for="name"
                        class="block text-sm/6 font-medium text-gray-900">Name</label>
                    <div class="mt-2">
                        <div
                            class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                            <input type="text" name="name" id="name"
                                class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6 border border-gray-500"
                                placeholder="Hollis Stacy"
                                value="{{ $customer->name ?? '' }}" required>
                            <!-- value is blank if variable not found (i.e create menu) -->
                        </div>
                        @error('name')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-4">
                    <label for="darbi_customer_account_number"
                        class="block text-sm/6 font-medium text-gray-900">Darbi
                        Customer Account Number: </label>
                    <div class="mt-2">
                        <div
                            class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                            <input type="text"
                                name="darbi_customer_account_number"
                                id="darbi_customer_account_number"
                                class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6 border border-gray-500"
                                placeholder="1234"
                                value="{{ $customer->darbi_customer_account_number ?? '' }}"
                                required>
                        </div>
                        @error('darbi_customer_account_number')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-4">
                    <label for="darbi_site"
                        class="block text-sm/6 font-medium text-gray-900">Darbi
                        Site</label>
                    <div class="mt-2">
                        <div
                            class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                            <input type="text" name="darbi_site"
                                id="darbi_site"
                                class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6 border border-gray-500"
                                placeholder="Site.com"
                                value="{{ $customer->darbi_site ?? '' }}"
                                required>
                        </div>
                        @error('darbi_site')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-4">
                    <label for="correspondence"
                        class="block text-sm/6 font-medium text-gray-900">Correspondence</label>
                    <div class="mt-2">
                        <div
                            class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                            <input type="text" name="correspondence"
                                id="correspondence"
                                class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6 border border-gray-500"
                                placeholder="email@email.com"
                                value="{{ $customer->correspondence ?? '' }}"
                                required>
                        </div>
                        @error('correspondence')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-4">
                    <label for="notes"
                        class="block text-sm/6 font-medium text-gray-900">Notes</label>
                    <div class="mt-2">
                        <div
                            class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                            <input type="text" name="notes" id="notes"
                                class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6 border border-gray-500"
                                placeholder="Extra Notes"
                                value="{{ $customer->notes ?? '' }}" />
                        </div>
                        @error('notes')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
        <a @click="show = false" href=""
            class="text-sm/6 font-semibold text-gray-900">Cancel</a>

        <button type="submit"
            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
    </div>
</form>
