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

    public function create(Request $request)
    {
        $isHTMX = $request->hasHeader('HX-Request');

        return view('contacts.create', compact('isHTMX'))
            ->fragmentIf($isHTMX, 'create-contact');
    }

    public function store(Request $request)
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

            $contact = Contact::create($data);
            $contact->update(['full_name' => $contact->last_name . ', ' . $contact->first_name . ' - ' . $contact->id]);

            if ($isHTMX) {
                return response(null, 204)->header('HX-Redirect', route('contacts.index'));
            }
            return redirect()->route('contacts.index');
        } catch (ValidationException $e) {
            if ($isHTMX) {
                return view('contacts.create', compact('isHTMX'))->withErrors($e->errors(), 'contact_errors')
                    ->fragment('create-contact');
            }
            throw $e;
        }
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

            $data += ['full_name' => ($data['last_name'] . ', ' . $data['first_name'] . ' - ' . $contact->id)];

            $contact->update($data);

            return view('contacts.show', compact('contact', 'isHTMX'))->fragmentIf($isHTMX, 'show-contact');
        } catch (ValidationException $e) {
            if ($isHTMX) {
                return view('contacts.show', compact('contact', 'isHTMX'))->withErrors($e->errors(), 'contact_errors')->fragment('show-contact');
            }
            throw $e;
        }
    }

    public function destroy(Request $request, Contact $contact)
    {
        $isHTMX = $request->hasHeader('HX-Request');

        if ($contact->contracts()->filter->isNotEmpty()->isNotEmpty() || $contact->invoices()->exists()) { // If contact is attached to contracts/invoices, return error
            return view('contacts.show', compact('contact', 'isHTMX'))->withErrors(['delete_error' => 'Cannot delete contacts attached to contracts and/or invoices.'])->fragmentIf($isHTMX, 'show-contact');
        }

        $contact->delete();
        return redirect()->route('contacts.index');
    }
}
