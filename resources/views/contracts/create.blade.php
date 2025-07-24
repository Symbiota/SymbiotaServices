<x-table-layout heading="Create Contract">
    <title>CREATE CONTRACT</title>

    <form method="POST" action="/contracts">
        @csrf
        
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">

                <x-form-box for="customer_id"> Customer ID*
                    <x-form-input type="text" name="customer_id" id="customer_id" value="{{ $customer->id ?? '' }}"></x-form-input>
                        @error('customer_id')
                            <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                        @enderror
                </x-form-box>

                <x-form-box for="original_contact_id"> Original Contact ID*
                    <x-form-input type="text" name="original_contact_id" id="original_contact_id"></x-form-input>
                        @error('original_contact_id')
                            <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                        @enderror
                </x-form-box>

                <x-form-box for="darbi_header_ref_1"> Darbi Header Ref 1*
                    <x-form-input type="text" name="darbi_header_ref_1" id="darbi_header_ref_1"></x-form-input>
                        @error('darbi_header_ref_1')
                            <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                        @enderror
                </x-form-box>

                <x-form-box for="darbi_header_ref_2"> Darbi Header Ref 2
                    <x-form-input type="text" name="darbi_header_ref_2" id="darbi_header_ref_2"></x-form-input>
                        @error('darbi_header_ref_2')
                            <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                        @enderror
                </x-form-box>

                <x-form-box for="darbi_special_instructions"> Darbi Special Instructions
                    <x-form-input type="text" name="darbi_special_instructions" id="darbi_special_instructions"></x-form-input>
                        @error('darbi_special_instructions')
                            <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                        @enderror
                </x-form-box>

                <x-form-box for="notes"> Notes
                        <x-form-input type="text" name="notes" id="notes"></x-form-input>
                        @error('notes')
                            <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                        @enderror
                </x-form-box>

                <x-form-box for="start_date"> Start Date*
                        <x-form-input type="text" name="start_date" id="start_date" placeholder="YYYY-MM-DD"></x-form-input>
                        @error('start_date')
                            <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                        @enderror
                </x-form-box>

                <x-form-box for="end_date"> End Date*
                        <x-form-input type="text" name="end_date" id="end_date" placeholder="YYYY-MM-DD"></x-form-input>
                        @error('end_date')
                            <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                        @enderror
                </x-form-box>

                <x-form-box for="service"> Select Service* (Hold ctrl or cmd to select multiple)
                    <div class="mt-2">
                        <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                        <select name="services[]" id="services" class="border" required multiple>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach
                        </select>
                        </div>
                            @error('service')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                    </div>
                </x-form-box>

            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="" class="text-sm/6 font-semibold text-gray-900">Cancel</a>

            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
        </div>
    </form>

</x-table-layout>