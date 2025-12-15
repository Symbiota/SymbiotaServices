@if (request()->routeIs('services.show') || request()->routeIs('contracts.show'))
    <button type="button" class="text-sm/6 font-semibold text-gray-900"
        onclick="toggleView('edit-form');">Cancel</button>
@elseif (request()->hasHeader('HX-Request'))
    <button type="button" class="text-sm/6 font-semibold text-gray-900"
        onclick="toggleView('modal-container');">Cancel</button>
@else
    <a class="text-sm/6 font-semibold text-gray-900"
        href="{{ url()->previous() }}">Cancel</a>
@endif
