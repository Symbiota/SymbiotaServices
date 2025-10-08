<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return view('services.index', ['services' => Service::all()]);
    }

    public function show(Request $request, Service $service)
    {
        $isHTMX = $request->hasHeader('HX-Request');

        return view('services.show', compact('service'))
            ->fragmentIf($isHTMX, 'show-service');
    }

    public function store()
    {
        request()->validate([
            'name' => ['required'],
            'darbi_item_number' => ['required', 'regex:/SYMBI\d{5}$/'],
            'price_per_unit' => ['required', 'numeric:strict'],
            'description' => ['required'],
        ]);

        $service = Service::create([
            'name' => request('name'),
            'darbi_item_number' => request('darbi_item_number'),
            'price_per_unit' => request('price_per_unit'),
            'description' => request('description'),
            'line_ref_1' => request('line_ref_1'),
            'line_ref_2' => request('line_ref_2'),
        ]);

        return redirect()->route('services.show', $service);
    }

    public function update(Service $service)
    {
        request()->validate([
            'name' => ['required'],
            'darbi_item_number' => ['required', 'regex:/SYMBI\d{5}$/'],
            'price_per_unit' => ['required', 'numeric:strict'],
            'description' => ['required'],
        ]);

        $service->update([
            'name' => request('name'),
            'darbi_item_number' => request('darbi_item_number'),
            'price_per_unit' => request('price_per_unit'),
            'description' => request('description'),
            'line_ref_1' => request('line_ref_1'),
            'line_ref_2' => request('line_ref_2'),
        ]);

        return redirect()->route('services.show', $service);
    }

    public function retire(Service $service)
    {
        $service->update([
            'active_status' => 0,
        ]);
        return redirect()->route('services.index');
    }
}
