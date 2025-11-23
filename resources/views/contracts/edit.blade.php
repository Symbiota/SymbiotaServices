<x-table-layout heading="Edit Contract {{ $contract->id }}:">
    @fragment('edit-contract')
        <x-modal-header :isHTMX="$isHTMX">Edit Contract {{ $contract->id }}:
        </x-modal-header>
        @if ($isHTMX)
            <x-contract-form hx-post="{{ route('contracts.update', $contract) }}"
                hx-target="#modal" hx-swap="innerHTML" :errors="$errors"
                :contract="$contract" :customers="$customers"
                :contacts="$contacts">@method('PATCH')</x-contract-form>
        @else
            <x-contract-form action="{{ route('contracts.update', $contract) }}"
                class="-mt-8" :contract="$contract" :customers="$customers"
                :contacts="$contacts">@method('PATCH')</x-service-form>
        @endif
    @endfragment
</x-table-layout>
