<x-table-layout heading="Invoices">
    <title>INVOICES PAGE</title>

    <a href="/invoices/create"> <x-ec-button>Create
            Invoice</x-ec-button></a>

    <br>
    <br>

    <div class = "space-y-4">
        @foreach ($invoices as $invoice)
            <a href="/invoices/{{ $invoice->id }}"
                class="block px-4 py-6 border border-gray-500">
                <ul><b>Invoice ID:</b> {{ $invoice->id }}</ul>
                <ul><b>Contract ID:</b> {{ $invoice->contract_id }}</ul>
                <ul><b>Amount Billed:</b> ${{ $invoice->amount_billed }}</ul>
                <b>Services:</b>
                @foreach ($invoice->services as $service)
                    <p class="ml-8">
                        {{ $service->name }}:
                        ${{ $service->pivot->amount_owed }}
                        ({{ $service->pivot->qty }})
                    </p>
                @endforeach
            </a>
        @endforeach
    </div>

</x-table-layout>
