<x-guest-layout>
    <div class="flex flex-col justify-center items-center text-center px-6">

        <h1 class="text-2xl font-bold mb-4">
            Device Management System
        </h1>

        <div class="flex gap-4">
            @auth
                <a href="{{ route('dashboard') }}" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Go to Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Login
                </a>

                <a href="{{ route('register') }}" class="bg-gray-200 px-6 py-2 rounded hover:bg-gray-300">
                    Register
                </a>
            @endauth
        </div>
    </div>
</x-guest-layout>
