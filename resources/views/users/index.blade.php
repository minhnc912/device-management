<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Users</h2>
    </x-slot>

    <div class="p-6 space-y-4">
        <form method="GET" class="flex gap-3 items-center">
            <input type="text" name="search" placeholder="Search name ..." value="{{ request('search') }}"
                class="border rounded px-3 py-2 w-60">

            <select name="role" class="border rounded px-3 py-2">
                <option value="">All Roles</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Filter</button>
            <a href="{{ route('users.index') }}" class="text-gray-600 underline">
                Reset
            </a>
        </form>
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-medium">User List</h3>
        </div>
    </div>

    <div class="mx-6 overflow-x-auto bg-white rounded shadow">

        <table class="w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Name</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Roles</th>
                    <th class="p-3 text-left">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-3">{{ $user->id }}</td>
                        <td class="p-3 font-medium">{{ $user->name }}</td>
                        <td class="p-3">{{ $user->email }}</td>
                        <td class="border p-2">
                            <div class="flex gap-1 flex-wrap">
                                @foreach ($user->getRoleNames()->take(3) as $role)
                                    <span class="bg-gray-200 text-xs px-2 py-1 rounded">
                                        {{ $role }}
                                    </span>
                                @endforeach

                                @if ($user->getRoleNames()->count() > 3)
                                    <span class="text-xs text-gray-500 flex items-center">
                                        +{{ $user->getRoleNames()->count() - 3 }} more
                                    </span>
                                @endif

                            </div>
                        </td>
                        <td class="p-3">
                            @can('user.edit')
                                <a href="{{ route('users.roles.edit', $user) }}" class="text-blue-600 hover:underline">
                                    Roles
                                </a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
