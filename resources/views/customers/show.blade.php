<x-table-layout heading="{{ $customer->name }}">
    <title>CUSTOMER: {{ $customer->name }}</title>
        
    <ul>
        <li><b>Name:</b> {{ $customer->name }}</li>
        <li><b>Darbi ID:</b>  {{ $customer->darbi_account }}</li>
        <li><b>Darbi site:</b>  {{ $customer->darbi_site }}</li>
        <!--<li><b>Correspondence:</b>  {{ $customer->correspondence }}</li>-->
        <li><b>Notes:</b>  {{ $customer->notes }}</li>
    </ul>

    <br>

    <div>
        @foreach($customer->contracts as $contract)
            <a href="/contracts/{{ $contract->id }}" class="block px-4 py-2 border border-gray-500">
                <div>
                    <b>Contract ID:</b> {{ $contract->id }}
                    <b>Customer ID:</b> {{ $contract->customer_id }}
                    <b>Original Contact ID:</b> {{ $contract->original_contract_id }}
                    <br>
                    <b>Start Date:</b> {{ $contract->start_date }}
                    <b>End Date:</b> {{ $contract->end_date }}
                    <br>
                    <b>Header Ref 1:</b> {{ $contract->darbi_header_ref_1 }}
                    <b>Header Ref 2:</b> {{ $contract->darbi_header_ref_2 }}
                    <br>
                    <b>Special Instructions:</b> {{ $contract->darbi_special_instructions }}
                    <br>
                    <b>Notes:</b> {{ $contract->notes }}
                </div>
            </a>
            <br>
        @endforeach
    </div>

    <br>

    <button onclick="toggleEditForm()" class='relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300'>Edit Customer</button>

    <script>
        function toggleEditForm() {
            var form = document.getElementById("edit-form");
            if (form.style.display === "none") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }
    </script>

    <div id="edit-form" style="display:none;"> <!--style=display:none; -->
        <form method="POST">
        @csrf
        @method('PATCH')
        
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-4">
                <label for="name" class="block text-sm/6 font-medium text-gray-900">Name</label>
                <div class="mt-2">
                    <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                    <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6 border border-gray-500" 
                    placeholder="Hollis Stacy"
                    value="{{ $customer->name }}"
                    required>
                    </div>
                    @error('name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                </div>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-4">
                <label for="darbi_account" class="block text-sm/6 font-medium text-gray-900">Darbi ID</label>
                <div class="mt-2">
                    <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                    <input type="text" 
                    name="darbi_account" 
                    id="darbi_account" 
                    class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6 border border-gray-500" 
                    placeholder="1234" 
                    value="{{ $customer->darbi_account }}"
                    required>
                    </div>
                    @error('darbi_account')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                </div>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-4">
                <label for="darbi_site" class="block text-sm/6 font-medium text-gray-900">Darbi Site</label>
                <div class="mt-2">
                    <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                    <input type="text" 
                    name="darbi_site" 
                    id="darbi_site" 
                    class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6 border border-gray-500" 
                    placeholder="site.com" 
                    value="{{ $customer->darbi_site }}"
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
                <label for="correspondence" class="block text-sm/6 font-medium text-gray-900">Correspondence</label>
                <div class="mt-2">
                    <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                    <input type="text" 
                    name="correspondence" 
                    id="correspondence" 
                    class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6 border border-gray-500" 
                    placeholder="email@email.com" 
                    value="{{ $customer->correspondence }}"
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
                <label for="notes" class="block text-sm/6 font-medium text-gray-900">Notes</label>
                <div class="mt-2">
                    <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                    <input type="text" 
                    name="notes" 
                    id="notes" 
                    class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6 border border-gray-500" 
                    placeholder="Extra Notes" 
                    value="{{ $customer->notes }}"
                    />
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
            <a href="/customers/{{ $customer->id }}" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
        </form>
    </div>

    <!--
    <a href="/customers/{{ $customer->id }}/edit" class='relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300'>Edit Customer</a>
    -->

</x-table-layout>