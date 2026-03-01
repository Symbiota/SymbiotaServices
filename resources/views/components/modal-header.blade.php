@if ($isHTMX)
    <header class="bg-white shadow-sm">
        <div class="flex items-center pb-4 mb-4">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                {{ $slot }}
            </h1>
            @if (isset($rightCondition))
                {{ $rightCondition }}
            @endif
            @if ($errors->any())
                <p class="text-red-500 text-base font-normal ml-auto mr-5">Error
                    Editing {{ $model }}</p>
            @endif
        </div>
    </header>
@endif
