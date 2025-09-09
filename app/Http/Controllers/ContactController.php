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

    public function store()
    {
        request()->validateWithBag('contact_errors', [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
        ]);

        Contact::create([
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'email' => request('email'),
            'phone_number' => request('phone_number'),
            'notes' => request('notes'),
        ]);

        return redirect()->back();
    }

    public function update(Contact $contact)
    {
        request()->validateWithBag('contact_errors', [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
        ]);

        $contact->update([
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'email' => request('email'),
            'phone_number' => request('phone_number'),
            'notes' => request('notes'),
        ]);

        return redirect()->route('contacts.show', $contact);
    }
}
