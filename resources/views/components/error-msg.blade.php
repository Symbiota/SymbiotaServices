@props(['for', 'bag' => 'default'])

@error($for, $bag)
    <p {{ $attributes->merge(['class' => 'text-red-500 text-sm ml-3']) }}>
        {{ $message }}</p>
@enderror
