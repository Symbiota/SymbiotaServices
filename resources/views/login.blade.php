<x-table-layout heading="Log into Account">
    <title>Log into SymbiotaServices</title>

    <form method="POST" action="{{ route('session.store') }}">
        @csrf

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">

                <x-form-box for="email" class="-mt-8"> Email
                    <x-form-input type="text" name="email" id="email"
                        value="{{ old('email') }}"></x-form-input>
                    @error('email')
                        <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                    @enderror
                </x-form-box>

                <x-form-box for="password"> Password
                    <x-form-input type="password" name="password"
                        id="password"></x-form-input>
                    @error('password')
                        <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                    @enderror
                </x-form-box>

            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="{{ route('home') }}"
                class="text-sm/6 font-semibold text-gray-900">Cancel</a>

            <button type="submit"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Log
                In</button>
        </div>
    </form>

</x-table-layout>
