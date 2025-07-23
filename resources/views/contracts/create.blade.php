<x-table-layout heading="Create Contract">
    <title>CREATE CONTRACT</title>

    <form method="POST" action="/contracts">
        @csrf
        
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                    <label for="customer_id" class="block text-sm/6 font-medium text-gray-900">Customer ID*</label>
                    <div class="mt-2">
                        <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                        <input 
                            type="text" 
                            name="customer_id"
                            id="customer_id" 
                            class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6 border border-gray-500" 
                            placeholder=""
                            value="{{ $customer->id ?? '' }}"
                        /> <!-- value is blank if variable not found (i.e create menu) -->
                        </div>
                            @error('customer_id')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                    </div>
                    </div>
                </div>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                    <label for="original_contact_id" class="block text-sm/6 font-medium text-gray-900">Original Contact ID*</label>
                    <div class="mt-2">
                        <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                        <input type="text" 
                            name="original_contact_id" 
                            id="original_contact_id" 
                            class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6 border border-gray-500" 
                            placeholder=""
                            value=""
                        />
                        </div>
                            @error('original_contact_id')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                    </div>
                    </div>
                </div>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                    <label for="darbi_header_ref_1" class="block text-sm/6 font-medium text-gray-900">Darbi Header Ref 1*</label>
                    <div class="mt-2">
                        <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                        <input type="text" 
                            name="darbi_header_ref_1" 
                            id="darbi_header_ref_1" 
                            class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6 border border-gray-500" 
                            placeholder="" 
                            value=""
                            />
                        </div>
                            @error('darbi_header_ref_1')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                    </div>
                    </div>
                </div>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                    <label for="darbi_header_ref_2" class="block text-sm/6 font-medium text-gray-900">Darbi Header Ref 2</label>
                    <div class="mt-2">
                        <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                        <input type="text" 
                            name="darbi_header_ref_2" 
                            id="darbi_header_ref_2" 
                            class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6 border border-gray-500" 
                            placeholder="" 
                            value=""
                            />
                        </div>
                            @error('darbi_header_ref_2')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                    </div>
                    </div>
                </div>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                    <label for="darbi_special_instructions" class="block text-sm/6 font-medium text-gray-900">Darbi Special Instructions</label>
                    <div class="mt-2">
                        <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                        <input type="text" 
                            name="darbi_special_instructions" 
                            id="darbi_special_instructions" 
                            class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6 border border-gray-500" 
                            placeholder="" 
                            value=""
                        />
                        </div>
                            @error('darbi_special_instructions')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                    </div>
                    </div>
                </div>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                    <label for="notes" class="block text-sm/6 font-medium text-gray-900">Notes</label>
                    <div class="mt-2">
                        <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                        <input type="text" 
                            name="notes" 
                            id="notes" 
                            class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6 border border-gray-500" 
                            placeholder=""
                            value="" 
                        />
                        </div>
                            @error('notes')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                    </div>
                    </div>
                </div>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                    <label for="start_date" class="block text-sm/6 font-medium text-gray-900">Start Date*</label>
                    <div class="mt-2">
                        <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                        <input type="text" 
                            name="start_date" 
                            id="start_date" 
                            class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6 border border-gray-500" 
                            placeholder="YYYY-MM-DD"
                            value="" 
                        />
                        </div>
                            @error('start_date')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                    </div>
                    </div>
                </div>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                    <label for="end_date" class="block text-sm/6 font-medium text-gray-900">End Date*</label>
                    <div class="mt-2">
                        <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                        <input type="text" 
                            name="end_date" 
                            id="end_date" 
                            class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6 border border-gray-500" 
                            placeholder="YYYY-MM-DD"
                            value="" 
                        />
                        </div>
                            @error('end_date')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                    </div>
                    </div>
                </div>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                    <label for="service" class="block text-sm/6 font-medium text-gray-900">Select Service (Hold ctrl or cmd to select multiple)</label>
                    <div class="mt-2">
                        <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                        <select name="services[]" id="services" class="border" multiple>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach
                        </select>
                        </div>
                            @error('service')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                    </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="" class="text-sm/6 font-semibold text-gray-900">Cancel</a>

            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
        </div>
    </form>

</x-table-layout>