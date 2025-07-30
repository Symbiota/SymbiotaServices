<?php

namespace App\Http\Controllers;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index() {
        return view('services.index', ['services' => Service::all()]);
    }

    public function show(Service $service) {
        return view('services.show', ['service' => $service]);
    }

    public function update(Service $service) {
        request()->validate([
            'name' => ['required'],
            'darbi_item_number' => ['required', 'numeric'],
            'price_per_unit' => ['required', 'numeric'],
            'description' => ['required'],
        ]);

        $service->update([
            'name' => request('name'),
            'darbi_item_number' => request('darbi_item_number'),
            'price_per_unit' => request('price_per_unit'),
            'description' => request('description'),
        ]);

        return redirect('/services/' . $service->id);
    }

    public function store() {
        request()->validate([
            'name' => ['required'],
            'darbi_item_number' => ['required', 'numeric'],
            'price_per_unit' => ['required', 'numeric'],
            'description' => ['required'],
        ]);

        $service = Service::create([
            'name' => request('name'),
            'darbi_item_number' => request('darbi_item_number'),
            'price_per_unit' => request('price_per_unit'),
            'description' => request('description'),
        ]);

        return redirect('/services/' . $service->id);
    }

}
