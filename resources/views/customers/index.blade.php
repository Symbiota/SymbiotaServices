<x-table-layout heading="Customers">
    <title>CUSTOMERS PAGE</title>
    @fragment('error-div')
        <div id="error-div" class="invisible">
            <span>Something went wrong</span>
        </div>
    @endfragment
    @fragment('customer-list')
        <div class = "space-y-4" id="customer-list-div">
            @foreach ($customers as $customer)
                <a href="/customers/{{ $customer['id'] }}" class="block px-4 py-6 border border-gray-500">
                    <strong>{{ $customer['name'] }}</strong>
                    <div>{{ $customer['darbi_account'] }}: {{ $customer['correspondence'] }}</div>
                </a>
            @endforeach
        </div>
    @endfragment
    <br>


    <div x-data = "{ show: false }" id="create-form">
        <button @click="show = true"
            class='relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300'>
            Create Customer
        </button>
        <form hx-post={{ url('/customer') }} hx-target="#customer-list-div" hx-swap="outerHTML" x-show = "show">
            @csrf
            <div id="customer-creation" class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label for="name" class="block text-sm/6 font-medium text-gray-900">Name</label>
                            <div class="mt-2">
                                <div
                                    class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                    <input type="text" name="name" id="name"
                                        class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6 border border-gray-500"
                                        placeholder="Hollis Stacy" required>
                                </div>
                                @error('name')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label for="darbi_account" class="block text-sm/6 font-medium text-gray-900">Darbi
                                ID</label>
                            <div class="mt-2">
                                <div
                                    class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                    <input type="text" name="darbi_account" id="darbi_account"
                                        class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6 border border-gray-500"
                                        placeholder="1234" required>
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
                                <div
                                    class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                    <input type="text" name="darbi_site" id="darbi_site"
                                        class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6 border border-gray-500"
                                        placeholder="50000" required>
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
                                    <input type="text" name="correspondence" id="correspondence"
                                        class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6 border border-gray-500"
                                        placeholder="email@email.com" required>
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
                                <div
                                    class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                    <input type="text" name="notes" id="notes"
                                        class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6 border border-gray-500"
                                        placeholder="Extra Notes" />
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
                <a href="#" class="text-sm/6 font-semibold text-gray-900" @click.prevent="show=false">
                    Cancel
                </a>
                <button type="submit" @click="show=false"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
            </div>
        </form>
    </div>


</x-table-layout>
