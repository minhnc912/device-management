<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Users</h2>
    </x-slot>

    <div class="p-6">

        <table class="w-full border">
            <thead>
                <tr class="bg-gray-100 hover:bg-gray-50">
                    <th class="border p-2">ID</th>
                    <th class="border p-2">Name</th>
                    <th class="border p-2">Email</th>
                    <th class="border p-2">Roles</th>
                    <th class="border p-2">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="border p-2">{{ $user->id }}</td>
                        <td class="border p-2">{{ $user->name }}</td>
                        <td class="border p-2">{{ $user->email }}</td>
                        <td class="border p-2">
                            {{ implode(', ', $user->getRoleNames()->toArray()) }}
                        </td>
                        <td class="border p-2">
                            <a class="text-blue-600"
                               href="{{ route('users.roles.edit', $user) }}">
                                Roles
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</x-app-layout>
