<div class="mt-8 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
    <div class="sm:col-span-5">
        <label
            {{ $attributes->merge(['class' => 'block text-sm/6 font-medium text-gray-900']) }}>{{ $slot }}</label>
    </div>
</div>
