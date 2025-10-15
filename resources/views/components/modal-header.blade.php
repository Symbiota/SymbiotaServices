@if ($isHTMX)
    <header class="bg-white shadow-sm">
        <div class="px-4 py-2 pb-4 mb-4">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                {{ $slot }} </h1>
        </div>
    </header>
@endif
