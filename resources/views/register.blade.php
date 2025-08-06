<x-table-layout heading="Register New Account">
    <title>REGISTER NEW ACCOUNT</title>

    <form method="POST">
        @csrf
        
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">

                <x-form-box for="name" class="-mt-8"> Name*
                    <x-form-input type="text" name="name" id="name" value="{{ old('name') }}"></x-form-input>
                        @error('name')
                            <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                        @enderror
                </x-form-box>

                <x-form-box for="email"> Email*
                    <x-form-input type="text" name="email" id="email" value="{{ old('email') }}"></x-form-input>
                        @error('email')
                            <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                        @enderror
                </x-form-box>

                <x-form-box for="password"> Password*
                    <x-form-input type="text" name="password" id="password" value="{{ old('password') }}"></x-form-input>
                        @error('password')
                            <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                        @enderror
                </x-form-box>

                <x-form-box for="password_confirmation"> Confirm Password*
                    <x-form-input type="text" name="password_confirmation" id="password_confirmation"></x-form-input>
                        @error('password_confirmation')
                            <p class="text-red-500 text-sm ml-3">{{ $message }}</p>
                        @enderror
                </x-form-box>

            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="/" class="text-sm/6 font-semibold text-gray-900">Cancel</a>

            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
        </div>
    </form>

</x-table-layout>