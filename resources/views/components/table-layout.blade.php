<!doctype html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/htmx.org@2.0.6/dist/htmx.min.js"
        integrity="sha384-Akqfrbj/HpNVo8k11SXBb6TlBWmXXlYQrCSqEWmyKJe+hDm3Z/B2WVG4smwBkRVm"
        crossorigin="anonymous"></script>
    <script src="{{ asset('show-hide.js') }}"></script>
</head>

<body class="h-full">
    <div class="min-h-full">
        <nav class="bg-gray-800">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="shrink-0">
                            <img class="h-12 w-17 bg-white rounded-xl"
                                src="{{ asset('LogoSymbiotaPNG.png') }}"
                                alt="Symbiota" />
                        </div>
                        <div class="ml-10 flex items-baseline space-x-4">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            @auth
                                <a href="/"
                                    class="{{ request()->is('/') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">Home</a>
                                <a href="{{ route('services.index') }}"
                                    class="{{ request()->is('services*') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">Services</a>
                                <a href="{{ route('customers.index') }}"
                                    class="{{ request()->is('customers*') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">Customers</a>
                                <a href="{{ route('contacts.index') }}"
                                    class="{{ request()->is('contacts') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">Contacts</a>
                                <a href="{{ route('contracts.index') }}"
                                    class="{{ request()->is('contracts*') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">Contracts</a>
                                <a href="{{ route('invoices.index') }}"
                                    class="{{ request()->is('invoices*') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">Invoices</a>
                            @endauth
                        </div>
                    </div>

                    <div class="ml-10 flex items-baseline space-x-4">
                        @guest
                            <a href="{{ route('register') }}"
                                class="{{ request()->is('register') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">Register</a>
                            <a href="{{ route('session.create') }}"
                                class="{{ request()->is('login') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">Log
                                In</a>
                        @endguest
                        @auth
                            <form method="POST"
                                action="{{ route('session.destroy') }}">
                                @csrf
                                <button type="submit"
                                    class="text-white hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Log
                                    Out</button>

                            </form>
                        @endauth
                    </div>

                </div>
            </div>
        </nav>

        <header class="bg-white shadow-sm">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                    {{ $heading }}</h1>
            </div>
        </header>
        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <!-- Your content -->
                {{ $slot }}
            </div>
        </main>
    </div>

</body>

</html>
