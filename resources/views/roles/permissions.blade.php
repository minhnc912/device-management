<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Permissions for: {{ $role->name }}
        </h2>
    </x-slot>

    <div class="p-6">

        <form method="POST">
            @csrf

            <div class="grid grid-cols-2 gap-3">
                @foreach($permissions as $permission)
                    <label class="flex items-center space-x-2 border p-2 rounded">
                        <input type="checkbox"
                               name="permissions[]"
                               value="{{ $permission->name }}"
                               {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>

                        <span>{{ $permission->name }}</span>
                    </label>
                @endforeach
            </div>

            <button class="mt-4 bg-green-500 text-white px-4 py-2 rounded">
                Save
            </button>
        </form>

    </div>
</x-app-layout>
