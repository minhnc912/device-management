<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Edit Role: {{ $role->name }}
        </h2>
    </x-slot>

    <div class="p-6">

        <form method="POST" action="{{ route('roles.update', $role) }}">
            @csrf
            @method('PUT')

            <div class="space-y-4">

                <div>
                    <label class="block mb-1">Role Name</label>

                    <input type="text" name="name" value="{{ old('name', $role->name) }}"
                        class="border rounded px-3 py-2 w-full">

                    @error('name')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex justify-center items-center gap-6">
                    <a href="{{ route('roles.index') }}"
                        class="bg-white text-black px-4 py-2 rounded hover:bg-white/50">
                        ← Back
                    </a>
                    <button class="bg-blue-600 text-white px-4 py-2 rounded">
                        Update
                    </button>
                </div>


            </div>

        </form>

    </div>
</x-app-layout>
