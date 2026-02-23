<div class="mt-8 grid grid-cols-6 gap-x-6 gap-y-8">
    <div
        class="{{ str_contains(request()->url(), 'edit') ? 'col-span-6' : 'col-span-5' }}">
        <label
            {{ $attributes->merge(['class' => 'block text-sm/6 font-medium']) }}>{{ $slot }}</label>
    </div>
</div>
