@props(['href' => null])

@php
    $classes =
        'relative inline-flex items-center px-4 py-2 mr-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:active:bg-gray-700 dark:active:text-gray-300';
@endphp

@if ($href)
    <a href="{{ $href }}"
        {{ $attributes->merge(['class' => "$classes"]) }}>{{ $slot }}</a>
@else
    <button
        {{ $attributes->merge(['class' => "$classes"]) }}>{{ $slot }}</button>
@endif
