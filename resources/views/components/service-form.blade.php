<form {{ $attributes->merge(['method' => 'post']) }}>
    @csrf
    {{ $slot }}
        
    <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">

            <x-form-box for="name"> Name*
                <x-form-input type="text" name="name" id="name" value="{{ $service->name ?? '' }}"></x-form-input>
                    @error('name')
                        <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                    @enderror
            </x-form-box>

            <x-form-box for="darbi_item_number"> Darbit Item Number*
                <x-form-input type="text" name="darbi_item_number" id="darbi_item_number" value="{{ $service->darbi_item_number ?? '' }}"></x-form-input>
                    @error('darbi_item_number')
                        <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                    @enderror
            </x-form-box>

            <x-form-box for="price_per_unit"> Price Per Unit*
                <x-form-input type="text" name="price_per_unit" id="price_per_unit" value="{{ $service->price_per_unit ?? '' }}"></x-form-input>
                    @error('customer_id')
                        <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                    @enderror
            </x-form-box>

            <x-form-box for="description"> Description*
                <x-form-input type="text" name="description" id="description" value="{{ $service->description ?? '' }}"></x-form-input>
                    @error('description')
                        <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                    @enderror
            </x-form-box>

        </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
        <a href="" class="text-sm/6 font-semibold text-gray-900">Cancel</a>

        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
    </div>
</form>