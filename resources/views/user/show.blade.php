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

    <div class="flex items-start">
        <div class="flex items-center">
            <x-ec-button onclick="toggleView('edit-form')">Edit
                User</x-ec-button>

            @if ($errors->any())
                <p class="text-red-500 text-sm ml-3">Error Editing User</p>
            @endif
        </div>
    </div>

    <form method="POST" id="edit-form"
        class="{{ $errors->any() ? '' : 'hidden' }}"
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
                    @error('name')
                        <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                    @enderror
                </x-form-box>

                <x-form-box for="email"> Email*
                    <x-form-input type="text" name="email" id="email"
                        value="{{ old('email') ?? $user->email }}"></x-form-input>
                    @error('email')
                        <p class="text-red-500 text-sm ml-3">{{ $message }}
                        </p>
                    @enderror
                </x-form-box>

                <x-form-box for="password"> Password*
                    <x-form-input type="password" name="password" id="password"
                        value=""></x-form-input>
                    @error('password')
                        <p class="text-red-500 text-sm ml-3">{{ $message }}
                        </p>
                    @enderror
                </x-form-box>

                <x-form-box for="password_confirmation"> Confirm Password*
                    <x-form-input type="password" name="password_confirmation"
                        id="password_confirmation"></x-form-input>
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm ml-3">{{ $message }}
                        </p>
                    @enderror
                </x-form-box>

            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <x-cancel-button>{{ route('home') }}</x-cancel-button>

            <button type="submit"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
        </div>
    </form>

    @endfragment('show-user')
</x-table-layout>
