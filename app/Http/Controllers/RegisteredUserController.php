<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('user.create');
    }

    public function show(Request $request)
    {
        $isHTMX = $request->hasHeader('HX-Request');
        return view('user.show', ['isHTMX' => $isHTMX, 'user' => auth()->user()])->fragmentIf($isHTMX, 'show-user');
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
        $isHTMX = $request->hasHeader('HX-Request');

        try {
            $data = $request->validateWithBag('user_errors', [
                'name' => ['required', \Illuminate\Validation\Rule::unique('users')->ignore(auth()->user()->id)],
                'email' => ['required', 'email', \Illuminate\Validation\Rule::unique('users')->ignore(auth()->user()->id)],
            ]);

            auth()->user()->update($data);

            return view('user.show', ['isHTMX' => $isHTMX, 'user' => auth()->user()])->fragmentIf($isHTMX, 'show-user');
        } catch (ValidationException $e) {
            if ($isHTMX) {
                return view('user.show', ['isHTMX' => $isHTMX, 'user' => auth()->user()])->withErrors($e->errors(), 'user_errors')->fragmentIf($isHTMX, 'show-user');
            }
            throw $e;
        }
    }

    public function changePassword(Request $request)
    {
        $isHTMX = $request->hasHeader('HX-Request');

        try {
            $data = $request->validateWithBag('password_errors', [
                'password' => ['required'],
                'password' => ['required', 'confirmed'],
            ]);

            auth()->user()->update($data);

            return view('user.show', ['isHTMX' => $isHTMX, 'user' => auth()->user()])->fragmentIf($isHTMX, 'show-user');
        } catch (ValidationException $e) {
            if ($isHTMX) {
                return view('user.show', ['isHTMX' => $isHTMX, 'user' => auth()->user()])->withErrors($e->errors(), 'password_errors')->fragmentIf($isHTMX, 'show-user');
            }
            throw $e;
        }
    }
}
