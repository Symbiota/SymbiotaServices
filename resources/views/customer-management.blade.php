<x-layout>
    <div class="flex justify-evenly">
        @fragment('customer-list-old')
            <div class="space-y-6 mr-8" id="customer-list-div">
                <h2 class="text-base/7 font-semibold text-900 text-white">Customers</h2>
                <ul>
                    @foreach ($customers as $customer)
                        <li class="text-white flex items-center space-x-2">
                            <a href='/customer/{{ $customer->id }}'>
                                - {{ $customer->name }}
                            </a>
                            <form hx-delete={{ url('/customer/' . $customer->id) }} hx-target="#customer-list-div"
                                hx-swap="outerHTML" hx-confirm="Are you sure you want to delete this customer?"
                                hx-indicator="#loading-spinner">
                                @csrf
                                <button type="submit" class="hover:text-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </form>
                            <div id="loading-spinner" class="hidden">Loading...</div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endfragment
        <div id="customer-create-form">
            @fragment('customer-create-form')
                <form hx-post={{ url('/customer/') }} hx-target="#customer-list-div" hx-swap="innerHTML">
                    @csrf
                    <div class="space-y-6">
                        <div class="border-b border-900/10 pb-12">
                            <h2 class="text-base/7 font-semibold text-900 text-white">Create a new customer</h2>
                            <p class="mt-1 text-sm/6 text-600 text-white">Use this form to create a new customer for biling.
                            </p>

                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="sm:col-span-4">
                                    <label for="customer-name"
                                        class="block text-sm/6 font-medium text-900 text-white">Customer (institution)
                                        Name</label>
                                    <div class="mt-2">
                                        <div
                                            class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                            <input type="text" name="customer-name" id="customer-name"
                                                class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                                                placeholder="e.g., University of Kansas" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="sm:col-span-4">
                                    <label for="customer-DARBI-number"
                                        class="block text-sm/6 font-medium text-900 text-white">Customer DARBI
                                        Number</label>
                                    <div class="mt-2">
                                        <div
                                            class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                            <input type="text" name="customer-DARBI-number" id="customer-DARBI-number"
                                                class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                                                placeholder="e.g., 1234" required />
                                        </div>
                                    </div>
                                </div>
                                <!-- TODO Add notes field -->
                            </div>
                        </div>
                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <button type="submit"
                                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Create
                            </button>
                        </div>
                        @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-white">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                </form>
            @endfragment
        </div>
    </div>
    <div id='indicator-div' x-data="{ show: true, message: '' }" x-show="show" x-transition x-text="message"
        class="bg-green-500 text-white px-4 py-2 rounded mb-4 w-full"
        @customer-created.window="message = $event.detail.message; show=true; setTimeout(()=> show=false, 3000)">

    </div>
</x-layout>
