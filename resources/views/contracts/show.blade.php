<x-table-layout heading="{{ $contract->id }}">
    <title>Contract: {{ $contract->id }}</title>
        
    <ul>
        <li><b>Contract ID:</b> {{ $contract->id }}</li>
        <li><b>Customer ID:</b> {{ $contract->customer_id }}</li>
        <li><b>original_contact_id:</b> {{ $contract->original_contact_id }}</li>
        <li><b>darbi_header_ref_1:</b> {{ $contract->darbi_header_ref_1 }}</li>
        <li><b>darbi_header_ref_2:</b> {{ $contract->darbi_header_ref_2 }}</li>
        <li><b>darbi_special_instructions:</b> {{ $contract->darbi_special_instructions }}</li>
        <li><b>notes:</b> {{ $contract->notes }}</li>
        <li><b>start_date:</b> {{ $contract->start_date }}</li>
        <li><b>end_date:</b> {{ $contract->end_date }}</li>
    </ul>

    <br>

    <div>
    @foreach($contract->services as $service)
        <div class="block px-4 py-2 border border-gray-500">
            <b>Service ID:</b> {{ $service->id }}
            <br>
            <b>Service Name:</b> {{ $service->name }}
            <br>
            <b>Description:</b> {{ $service->description }}
            <br>
            <b>Price per unit:</b> {{ $service->price_per_unit }}
            <br>
            <b>Darbi Item Number:</b> {{ $service->darbi_item_number }}
        </div>
    @endforeach
    </div>


</x-table-layout>