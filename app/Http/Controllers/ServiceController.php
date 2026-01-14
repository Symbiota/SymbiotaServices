<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function index()
    {
        return view('services.index', ['services' => Service::all()]);
    }

    public function show(Request $request, Service $service)
    {
        $isHTMX = $request->hasHeader('HX-Request');

        return view('services.show', compact('service', 'isHTMX'))
            ->fragmentIf($isHTMX, 'show-service');
    }

    public function create(Request $request)
    {
        $isHTMX = $request->hasHeader('HX-Request');

        return view('services.create', compact('isHTMX'))
            ->fragmentIf($isHTMX, 'create-service');
    }

    public function store(Request $request)
    {
        $isHTMX = $request->hasHeader('HX-Request');

        try {
            $data = $request->validate(
                [
                    'name' => ['required'],
                    'darbi_item_number' => ['required', 'regex:/SYMBI\d{5}$/'],
                    'price_per_unit' => ['required', 'numeric:strict'],
                    'description' => ['nullable'],
                ],
                [
                    'darbi_item_number.regex' => 'DARBI Item Number should be SYMBI + 5 digits.'
                ]
            );

            $service = Service::create($data);

            $history = $service->getAttributes();
            unset($history['id']);
            DB::table('services_history')->insert($history += ['service_id' => $service->id]);

            if ($isHTMX) {
                return response(null, 204)->header('HX-Redirect', route('services.index'));
            }
            return redirect()->route('services.index');
        } catch (ValidationException $e) {
            if ($isHTMX) {
                return view('services.create', compact('isHTMX'))->withErrors($e->errors())
                    ->fragment('create-service');
            }
            throw $e;
        }
    }

    public function update(Request $request, Service $service)
    {
        $isHTMX = $request->hasHeader('HX-Request');

        try {
            $data = $request->validate(
                [
                    'name' => ['required'],
                    'darbi_item_number' => ['required', 'regex:/SYMBI\d{5}$/'],
                    'price_per_unit' => ['required', 'numeric:strict'],
                    'description' => ['nullable'],
                ],
                [
                    'darbi_item_number.regex' => 'DARBI Item Number should be SYMBI + 5 digits.'
                ]
            );

            $service->update($data);

            $history = $service->getAttributes();
            unset($history['id']);
            DB::table('services_history')->insert($history += ['service_id' => $service->id]);

            return view('services.show', compact('service', 'isHTMX'))->fragmentIf($isHTMX, 'show-service');
        } catch (ValidationException $e) {
            if ($isHTMX) {
                return view('services.show', compact('service', 'isHTMX'))->withErrors($e->errors())->fragment('show-service');
            }
            throw $e;
        }
    }

    public function retire(Service $service)
    {
        $service->update([
            'active_status' => 0,
        ]);
        return redirect()->route('services.index');
    }
}
