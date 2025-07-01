<x-layout>
   <form method="POST" action="/customer">
      @csrf
      <div class="space-y-12">
         <div class="border-b border-900/10 pb-12">
            <h2 class="text-base/7 font-semibold text-900 text-white">Create a new customer</h2>
            <p class="mt-1 text-sm/6 text-600 text-white">Use this form to create a new customer for biling.</p>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-4">
               <label for="customer-name" class="block text-sm/6 font-medium text-900 text-white">Customer (institution) Name</label>
               <div class="mt-2">
                  <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                  <input type="text" name="customer-name" id="customer-name" class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" placeholder="University of Kansas" />
                  </div>
               </div>
            </div>
            <div class="sm:col-span-4">
               <label for="customer-DARBI-number" class="block text-sm/6 font-medium text-900 text-white">Customer DARBI Number</label>
               <div class="mt-2">
                  <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                  <input type="text" name="customer-DARBI-number" id="customer-DARBI-number" class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" placeholder="1234" />
                  </div>
               </div>
            </div>


         </div>


      </div>

      <div class="mt-6 flex items-center justify-end gap-x-6">
         <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create</button>
      </div>
   </form>
</x-layout>