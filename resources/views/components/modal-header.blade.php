@if ($isHTMX)
    <header class="bg-white shadow-sm">
        <div class="pb-4 mb-4">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                {{ $slot }} </h1>
        </div>
    </header>
@endif
