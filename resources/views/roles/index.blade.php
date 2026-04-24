<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Roles</h2>
    </x-slot>

    <div class="p-6">

        <div class="mb-4">
            <a href="{{ route('roles.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded">
                + Create Role
            </a>
        </div>

        <table class="w-full border border-gray-300">
            <thead>
                <tr class="bg-gray-100 hover:bg-gray-50">
                    <th class="p-2 border">ID</th>
                    <th class="p-2 border">Name</th>
                    <th class="p-2 border">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td class="p-2 border">{{ $role->id }}</td>
                        <td class="p-2 border">{{ $role->name }}</td>
                        <td class="p-2 border space-x-2">
                            <a class="text-blue-600"
                               href="{{ route('roles.permissions.edit', $role) }}">
                                Permissions
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</x-app-layout>
