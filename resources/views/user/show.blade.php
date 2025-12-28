<x-table-layout heading="User Account:">
    @fragment('show-user')
    <title>Edit Account - SymbiotaServices</title>
    <x-modal-header :isHTMX="$isHTMX">User Account:</x-modal-header>

    <ul>
        <li><b>Username:</b> {{ $user->name }}</li>
        <li><b>Email:</b> {{ $user->email }}</li>
        <x-timestamps :model="$user"></x-timestamps>
    </ul>

    <br>

    <div class="flex items-center">
        <x-ec-button
            onclick="toggleView('edit-form');document.getElementById('password-form').classList.add('hidden');">Edit
            User</x-ec-button>

        <x-ec-button
            onclick="toggleView('password-form');document.getElementById('edit-form').classList.add('hidden');">Change
            Password</x-ec-button>

        @if ($errors->any())
            <p class="text-red-500 text-sm ml-3">Error Editing User</p>
        @endif
    </div>

    <form method="POST" id="edit-form"
        class="{{ $errors->user_errors->any() ? '' : 'hidden' }}"
        @if ($isHTMX) hx-post="{{ route('user.update') }}"
        hx-target="#modal"
        hx-swap="innerHTML scroll:top"
        @else
        action="{{ route('user.update') }}" @endif>
        @csrf
        @method('PATCH')

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">

                <x-form-box for="name"> Name*
                    <x-form-input type="text" name="name" id="name"
                        value="{{ old('name') ?? $user->name }}"></x-form-input>
                    @error('name', 'user_errors')
                        <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                    @enderror
                </x-form-box>

                <x-form-box for="email"> Email*
                    <x-form-input type="text" name="email" id="email"
                        value="{{ old('email') ?? $user->email }}"></x-form-input>
                    @error('email', 'user_errors')
                        <p class="text-red-500 text-sm ml-3">{{ $message }}
                        </p>
                    @enderror
                </x-form-box>

            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <x-cancel-button></x-cancel-button>

            <button type="submit"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
        </div>
    </form>

    <form method="POST" id="password-form"
        class="{{ $errors->password_errors->any() ? '' : 'hidden' }}"
        @if ($isHTMX) hx-post="{{ route('user.changePassword') }}"
        hx-target="#modal"
        hx-swap="innerHTML scroll:top"
        @else
        action="{{ route('user.changePassword') }}" @endif>
        @csrf
        @method('PATCH')

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">

                <x-form-box for="password"> Password*
                    <x-form-input type="password" name="password" id="password"
                        value=""></x-form-input>
                    @error('password', 'password_errors')
                        <p class="text-red-500 text-sm ml-3">{{ $message }}
                        </p>
                    @enderror
                </x-form-box>

                <x-form-box for="password_confirmation"> Confirm Password*
                    <x-form-input type="password" name="password_confirmation"
                        id="password_confirmation"></x-form-input>
                    @error('password_confirmation', 'password_errors')
                        <p class="text-red-500 text-sm ml-3">{{ $message }}
                        </p>
                    @enderror
                </x-form-box>

            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" class="text-sm/6 font-semibold text-gray-900"
                onclick="toggleView('password-form');">Cancel</button>

            <button type="submit"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
        </div>
    </form>

    @endfragment('show-user')
</x-table-layout>
