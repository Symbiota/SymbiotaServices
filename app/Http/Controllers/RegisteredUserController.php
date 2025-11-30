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

    public function edit()
    {
        return view('account', ['user' => auth()->user()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required'],
            'password' => ['required', 'confirmed'],
        ]);

        $user = User::create($data);

        Auth::login($user);

        return redirect('/');
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', \Illuminate\Validation\Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'email'],
            'password' => ['required'],
            'password' => ['required', 'confirmed'],
        ]);

        $user->update($data);

        return view('account');
    }
}
