<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Roles</h2>
    </x-slot>

    <div class="p-6 space-y-4">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded text-sm">
                {{ session('success') }}
            </div>
        @endif
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-medium">Role List</h3>
            @can('roles.create')
                <a href="{{ route('roles.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    + Create Role
                </a>
            @endcan
        </div>
        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left">ID</th>
                        <th class="p-3 text-left">Name</th>
                        <th class="p-3 text-left">Permissions</th>
                        <th class="p-3 text-left">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($roles as $role)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="p-3">{{ $role->id }}</td>
                            <td class="p-3 font-medium">{{ $role->name }}</td>
                            <td class="p-3">
                                <div class="flex flex-wrap gap-1">
                                    @foreach ($role->permissions->take(3) as $perm)
                                        <span class="bg-gray-200 text-xs px-2 py-1 rounded">
                                            {{ $perm->name }}
                                        </span>
                                    @endforeach

                                    @if ($role->permissions->count() > 3)
                                        <span class="text-xs text-gray-500 flex items-center">
                                            +{{ $role->permissions->count() - 3 }} more
                                        </span>
                                    @endif
                                </div>
                            <td class="p-3 space-x-2">
                                @can('roles.permissions.manage')
                                    <a href="{{ route('roles.permissions.edit', $role) }}"
                                        class="text-indigo-600 hover:underline">
                                        Permissions
                                    </a>
                                @endcan

                                @can('roles.edit')
                                    <a href="{{ route('roles.edit', $role) }}" class="text-blue-600 hover:underline">
                                        Edit
                                    </a>
                                @endcan

                                @can('roles.delete')
                                    <form action="{{ route('roles.destroy', $role) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:underline"
                                            onclick="return confirm('Delete this role?')">
                                            Delete
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
