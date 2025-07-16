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

}
