<x-table-layout
    heading="Contact: {{ $contact->first_name }} {{ $contact->last_name }}">

    @fragment('show-contact')
        <title>Contact: {{ $contact->first_name }} {{ $contact->last_name }}</title>

        <x-modal-header :isHTMX="$isHTMX">{{ $contact->first_name }}
            {{ $contact->last_name }}
        </x-modal-header>

        <ul>
            <li><b>Contact ID:</b> {{ $contact->id }}</li>
            <li><b>Name:</b> {{ $contact->first_name }} {{ $contact->last_name }}
            </li>
            <li><b>Email:</b> {{ $contact->email }}</li>
            <li><b>Phone Number:</b> {{ $contact->phone_number }}</li>
            <li><b>Notes:</b> {{ $contact->notes }}</li>
            <x-timestamps :model="$contact"></x-timestamps>
        </ul>

        <br>

        <div class="flex items-start">
            <div class="flex items-center">

                <form method="POST"
                    @if ($isHTMX) hx-post="{{ route('contacts.destroy', $contact) }}"
                    hx-target="#modal" hx-swap="innerHTML scroll:top"
                    @else action="{{ route('contacts.destroy', $contact) }}" @endif>
                    @csrf
                    @method('DELETE') <x-ec-button type="submit"
                        class="!border-red-500 !text-red-500"
                        onclick="return confirm('Delete this contact?');">Delete
                        Contact</x-ec-button>
                </form>

                <x-ec-button onclick="toggleView('edit-form')">Edit
                    Contact</x-ec-button>

                <x-ec-button onclick="toggleView('show-attachments')">Show
                    Attachments</x-ec-button>

                @if ($errors->contact_errors->any())
                    <p class="text-red-500 text-sm ml-3">Error Editing Contact
                    </p>
                @endif
            </div>
        </div>

        <br>

        @error('delete_error')
            <div class="text-red-500 text-sm ml-3 -mt-2">
                <p>{{ $message }}</p>
                <br>
            </div>
        @enderror

        <div id="show-attachments" class="hidden">
            <div class="underline flex gap-4">
                @foreach ($contact->contracts_by_original_contact as $o_contract)
                    <a href="{{ route('contracts.show', $o_contract) }}">Original
                        Contact: {{ $o_contract->id }}</a>
                @endforeach
                @foreach ($contact->contracts_by_current_financial_contact as $cf_contract)
                    <a href="{{ route('contracts.show', $cf_contract) }}">Current
                        Financial Contact: {{ $cf_contract->id }}</a>
                @endforeach
                @foreach ($contact->contracts_by_pi_contact as $pi_contract)
                    <a href="{{ route('contracts.show', $pi_contract) }}">Pi
                        Contact: {{ $pi_contract->id }}</a>
                @endforeach
                @foreach ($contact->contracts_by_technical_contact as $t_contract)
                    <a href="{{ route('contracts.show', $t_contract) }}">SSH
                        Internal Contact: {{ $t_contract->id }}</a>
                @endforeach
            </div>
            <br>
            @foreach ($contact->invoices as $invoice)
                <a class="mr-4 underline"
                    href="{{ route('invoices.show', $invoice) }}">Invoice:
                    {{ $invoice->id }}</a>
            @endforeach
            <br><br>
        </div>

        <div id="edit-form"
            class="{{ $errors->contact_errors->any() ? '' : 'hidden' }} -mt-6">
            @if ($isHTMX)
                <x-contact-form class="-mt-2" :errors="$errors" :contact="$contact"
                    hx-post="{{ route('contacts.update', $contact) }}"
                    hx-target="#modal"
                    hx-swap="innerHTML scroll:top">@method('PATCH')</x-contact-form>
            @else
                <x-contact-form action="{{ route('contacts.update', $contact) }}"
                    :contact="$contact">@method('PATCH')</x-contact-form>
            @endif
        </div>
    @endfragment

</x-table-layout>
