<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contacts.index', ['contacts' => Contact::all()]);
    }

    public function show(Contact $contact)
    {
        return view('contacts.show', ['contact' => $contact]);
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
        $data = $request->validateWithBag('contact_errors', [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'phone_number' => ['nullable'],
            'notes' => ['nullable'],
        ]);

        $contact->update($data);

        return redirect()->route('contacts.show', $contact);
    }
}
