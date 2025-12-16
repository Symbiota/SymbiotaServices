<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Dotenv\Exception\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('login');
    }

    public function store()
    {
        $validatedAttributes = request()->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($validatedAttributes)) {
            request()->session()->regenerate();
            return redirect('/');
        } else {
            return back()->withErrors([
                'password' => ['Wrong password.']
            ])->withInput();
        }
    }

    public function destroy()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }
}
