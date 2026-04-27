<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Update Roles: {{ $user->name }}
        </h2>
    </x-slot>

    <div class="px-6 py-4 max-w-2xl mx-auto">
        <div>
            <h3 class="text-sm text-gray-600 mb-2">Current Roles</h3>

            <div class="flex flex-wrap gap-2">
                @forelse ($user->getRoleNames() as $role)
                    <span class="bg-blue-100 text-blue-700 px-2 py-1 text-xs rounded">
                        {{ $role }}
                    </span>
                @empty
                    <span class="text-gray-400 text-sm">No roles</span>
                @endforelse
            </div>
        </div>

        <form method="POST" class="space-y-6">
            @csrf
            <div class="bg-white shadow rounded p-4 space-y-3">
                <div class="flex justify-between items-center">
                    <h3 class="font-medium text-lg">Assign Roles</h3>
                    <label class="flex items-center gap-2 cursor-pointer text-sm text-gray-600">
                        <input type="checkbox" onclick="toggleAllRoles(this)">
                        <span>Check All</span>
                    </label>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    @foreach ($roles as $role)
                        <label class="flex items-center gap-2 border p-2 rounded cursor-pointer hover:bg-gray-50">
                            <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                                {{ $user->hasRole($role->name) ? 'checked' : '' }}
                                @if ($role->name === 'admin' && $user->hasRole('admin')) disabled @endif>
                            <span class="capitalize">
                                {{ $role->name }}
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>
            <div class="flex justify-center items-center gap-6">
                <a href="{{ route('users.index') }}" class="bg-white text-black px-4 py-2 rounded hover:bg-white/50">
                    ← Back
                </a>
                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Save
                </button>
            </div>
        </form>
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded text-sm">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <script>
        function toggleAllRoles(source) {
            document.querySelectorAll('input[name="roles[]"]').forEach(cb => {
                cb.checked = source.checked;
            });
        }
    </script>
</x-app-layout>
