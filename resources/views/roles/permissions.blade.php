<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Permissions: {{ $role->name }}
        </h2>
    </x-slot>

    <div class="p-6">
        <form method="POST">
            @csrf
            <div class="space-y-6">
                @foreach ($grouped as $module => $permissions)
                    <div class="border rounded p-4">
                        <div class="flex justify-between items-center">
                            <h3 class="font-semibold mb-3 capitalize">
                                {{ $module }}
                            </h3>
                            <label class="flex items-center gap-2 cursor-pointer text-sm text-gray-600">
                                <input type="checkbox" onclick="toggleGroup(this)">
                                <span>Check All</span>
                            </label>
                        </div>

                        <div class="grid grid-cols-3 gap-3">

                            @foreach ($permissions as $permission)
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                        {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                    <span>
                                        {{ explode('.', $permission->name)[1] }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach

            </div>

            <div class="mt-6 flex justify-center items-center gap-6">
                <a href="{{ route('roles.index') }}" class="bg-white text-black px-4 py-2 rounded hover:bg-white/50">
                    ← Back
                </a>
                <button class="bg-blue-600 text-white px-4 py-2 rounded">
                    Save
                </button>
            </div>


        </form>

    </div>
    <script>
        function toggleGroup(source) {
            const container = source.closest('.border');
            const checkboxes = container.querySelectorAll('input[name="permissions[]"]');

            checkboxes.forEach(cb => {
                cb.checked = source.checked;
            });
        }
    </script>
</x-app-layout>
