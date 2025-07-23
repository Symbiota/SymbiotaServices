<x-table-layout heading="Contract: {{ $contract->id }}">
    <title>Contract: {{ $contract->id }}</title>
        
    <ul>
        <li><b>Contract ID:</b> {{ $contract->id }}</li>
        <li><a href="/customers/{{ $contract->customer_id }}"><b>Customer ID:</b> {{ $contract->customer_id }}</a></li>
        <li><b>Original Contact ID:</b> {{ $contract->original_contact_id }}</li>
        <li><b>Darbi Header Ref 1:</b> {{ $contract->darbi_header_ref_1 }}</li>
        <li><b>Darbi Header Ref 2:</b> {{ $contract->darbi_header_ref_2 }}</li>
        <li><b>Darbi Special Instructions:</b> {{ $contract->darbi_special_instructions }}</li>
        <li><b>Notes:</b> {{ $contract->notes }}</li>
        <li><b>Start Date:</b> {{ $contract->start_date }}</li>
        <li><b>End Date:</b> {{ $contract->end_date }}</li>
    </ul>

    <br>

    <div>
    @foreach($contract->services as $service)
        <a href="/services/{{ $service->id }}">
            <ul class="block px-4 py-2 border border-gray-500">
                <li><b>Service ID:</b> {{ $service->id }}</li>
                <li><b>Service Name:</b> {{ $service->name }}</li>
                <li><b>Description:</b> {{ $service->description }}</li>
                <li><b>Price per unit:</b> {{ $service->price_per_unit }}</li>
                <li><b>Darbi Item Number:</b> {{ $service->darbi_item_number }}</li>
            </ul>
        </a>
    <br>
    @endforeach
    </div>

</x-table-layout>