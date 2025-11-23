<form {{ $attributes->merge(['method' => 'POST']) }}>
    @csrf
    {{ $slot }}

    <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">

            <x-form-box for="name"> Name*
                <x-form-input type="text" name="name" id="name"
                    value="{{ $service->name ?? (old('name') ?? request()->input('name')) }}"></x-form-input>
                @error('name')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

            <x-form-box for="darbi_item_number"> DARBI Item Number*
                <x-form-input type="text" name="darbi_item_number"
                    id="darbi_item_number" placeholder="SYMBI01234"
                    value="{{ $service->darbi_item_number ?? (old('darbi_item_number') ?? request()->input('darbi_item_number')) }}"></x-form-input>
                @error('darbi_item_number')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

            <x-form-box for="price_per_unit"> Price Per Unit*
                <x-form-input type="text" name="price_per_unit"
                    id="price_per_unit"
                    value="{{ $service->price_per_unit ?? (old('price_per_unit') ?? request()->input('price_per_unit')) }}"></x-form-input>
                @error('price_per_unit')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

            <x-form-box for="description"> Description
                <textarea
                    class="block min-w-0 w-[98.5%] grow py-1.5 pr-3 pl-1 ml-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6 border border-gray-500"
                    name="description" id="description">{{ $service->description ?? (old('description') ?? request()->input('description')) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

            <x-form-box for="line_ref_1"> Line Reference 1
                <x-form-input type="text" name="line_ref_1" id="line_ref_1"
                    value="{{ $service->line_ref_1 ?? (old('line_ref_1') ?? request()->input('line_ref_1')) }}"></x-form-input>
                @error('line_ref_1')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

            <x-form-box for="line_ref_2"> Line Reference 2
                <x-form-input type="text" name="line_ref_2" id="line_ref_2"
                    value="{{ $service->line_ref_2 ?? (old('line_ref_2') ?? request()->input('line_ref_2')) }}"></x-form-input>
                @error('line_ref_2')
                    <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                @enderror
            </x-form-box>

        </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
        <button class="text-sm/6 font-semibold text-gray-900"
            onclick="toggleView('edit-form');">Cancel</button>

        <button type="submit"
            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
    </div>

    <script>
        const price_per_unit = document.getElementById('price_per_unit');

        price_per_unit.addEventListener('input', function() {
            price_per_unit.value = price_per_unit.value.replace(/,/g, '');
        });
    </script>
</form>
