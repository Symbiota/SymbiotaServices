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


    <div>
    @foreach($contract->services as $service)
        <div>
            <li><b>id:</b>  {{ $service->id }}</li>
            <li><b>name:</b>  {{ $service->name }}</li>
        </div>
        <br>
    @endforeach
    </div>


</x-table-layout>