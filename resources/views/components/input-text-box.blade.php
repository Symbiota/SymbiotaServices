

<div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
    <div class="sm:col-span-4">
        <label for="{{ $variable }}" class="block text-sm/6 font-medium text-gray-900">{{ $variable }}</label>
        <div class="mt-2">
            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                <input 
                    type="text" 
                    name="{{ $variable }}"
                    id="{{ $variable }}" 
                    class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6 border border-gray-500" 
                    placeholder="Hollis Stacy"
                required>
            </div>
                @error('{{ $variable }}')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
        </div>
    </div>
</div>