<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ContactController extends Controller
{
    public function index()
    {
        return view('contacts.index', ['contacts' => Contact::all()]);
    }

    public function show(Request $request, Contact $contact)
    {
        $isHTMX = $request->hasHeader('HX-Request');

        return view('contacts.show', compact('contact', 'isHTMX'))
            ->fragmentIf($isHTMX, 'show-contact');
    }

    public function store(Request $request)
    {
        $data = $request->validateWithBag('contact_errors', [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'phone_number' => ['nullable'],
            'notes' => ['nullable'],
        ]);

        Contact::create($data);

        return redirect()->back();
    }

    public function update(Request $request, Contact $contact)
    {
        $isHTMX = $request->hasHeader('HX-Request');

        try {
            $data = $request->validateWithBag('contact_errors', [
                'first_name' => ['required'],
                'last_name' => ['required'],
                'email' => ['required', 'email'],
                'phone_number' => ['nullable'],
                'notes' => ['nullable'],
            ]);

            $contact->update($data);

            return view('contacts.show', compact('contact', 'isHTMX'))->fragmentIf($isHTMX, 'show-contact');

        } catch (ValidationException $e) {
            if ($isHTMX) {
                return view('contacts.show', compact('contact', 'isHTMX'))->withErrors($e->errors(), 'contact_errors')->fragment('show-contact');
            }
            throw $e;
        }

    }
}
