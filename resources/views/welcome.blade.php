<x-table-layout heading="Home">
    <title>HOME PAGE</title>
    @guest
        <a href="{{ url('register') }}"
            class="{{ request()->is('register') ? 'bg-gray-900 text-white' : 'text-gray-300 bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">Register</a>
        <br>
        <br>
        <a href="{{ route('session.create') }}"
            class="{{ request()->is('login') ? 'bg-gray-900 text-white' : 'text-gray-300 bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">Log
            In</a>
    @endguest
    @auth
        <p>Welcome to Symbiota Services!</p>
        <br>
        <p>Current version: {{ config('app.version') }}</p>
    @endauth
</x-table-layout>
