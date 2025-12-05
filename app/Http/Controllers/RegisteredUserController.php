<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('register');
    }

    public function show(Request $request)
    {
        $isHTMX = $request->hasHeader('HX-Request');
        return view('account', [
            'isHTMX' => $isHTMX,
            'user' => auth()->user()
        ])->fragmentIf($isHTMX, 'show-user');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'unique:users,name'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required'],
            'password' => ['required', 'confirmed'],
        ]);

        $user = User::create($data);

        Auth::login($user);

        return redirect('/');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', \Illuminate\Validation\Rule::unique('users')->ignore(auth()->user()->id)],
            'email' => ['required', 'email', \Illuminate\Validation\Rule::unique('users')->ignore(auth()->user()->id)],
            'password' => ['required'],
            'password' => ['required', 'confirmed'],
        ]);

        auth()->user()->update($data);

        return redirect()->route('user.show', ['user' => auth()->user()]);
    }
}
