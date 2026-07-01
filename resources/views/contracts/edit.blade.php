<x-table-layout heading="Edit Contract {{ $contract->id }}:">
    @fragment('edit-contract')
        <x-modal-header :isHTMX="$isHTMX" :errors="$errors" model="Contract">Edit
            Contract
            {{ $contract->id }}:</x-modal-header>

        @if ($isHTMX)
            <x-forms.contract-form
                hx-post="{{ route('contracts.update', $contract) }}"
                hx-target="#modal" hx-swap="innerHTML scroll:top" :errors="$errors"
                :contract="$contract" :customers="$customers"
                :contacts="$contacts">@method('PATCH')</x-forms.contract-form>
        @else
            <x-forms.contract-form
                action="{{ route('contracts.update', $contract) }}" class="-mt-8"
                :contract="$contract" :customers="$customers"
                :contacts="$contacts">@method('PATCH')</x-forms.contract-form>
        @endif
    @endfragment
</x-table-layout>
