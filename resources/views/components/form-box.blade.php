<div class="mt-8 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
    <div
        class="{{ request()->is('contracts/create*') || request()->is('invoices/create*') ? 'sm:col-span-5' : 'sm:col-span-4' }}">
        <label
            {{ $attributes->merge(['class' => 'block text-sm/6 font-medium text-gray-900']) }}>{{ $slot }}</label>
    </div>
</div>
