<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index() {
        return view('contacts.index', ['contacts' => Contact::all()]);
    }

    public function show(Contact $contact) {
        return view('contacts.show', ['contact' => $contact]);
    }
}
