<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Activity Logs</h2>
    </x-slot>

    <div class="p-6 space-y-4">

        <form method="GET" class="flex gap-3 items-center">
            <select name="user_id" class="border px-3 py-2 rounded">
                <option value="">All Users</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            <select name="action" class="border px-3 py-2 rounded">
                <option value="">All Action</option>
                @foreach (['create', 'update', 'delete'] as $action)
                    <option value="{{ $action }}" {{ request('action') == $action ? 'selected' : '' }}>
                        {{ ucfirst($action) }}
                    </option>
                @endforeach
            </select>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Filter
            </button>

            <a href="{{ route('logs.index') }}" class="text-gray-600 underline">
                Reset
            </a>

        </form>

        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left">User</th>
                        <th class="p-3 text-left">Action</th>
                        <th class="p-3 text-left">Model</th>
                        <th class="p-3 text-left">Description</th>
                        <th class="p-3 text-left">Time</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($logs as $log)
                        <tr class="border-t">
                            <td class="p-3">{{ $log->user->name }}</td>
                            @php
                                $color = match ($log->action) {
                                    'create' => 'bg-green-100 text-green-700',
                                    'update' => 'bg-blue-100 text-blue-700',
                                    'delete' => 'bg-red-100 text-red-700',
                                    default => 'bg-gray-100 text-gray-600',
                                };
                            @endphp

                            <td class="p-3">
                                <span class="px-2 py-1 text-xs rounded {{ $color }}">
                                    {{ strtoupper($log->action) }}
                                </span>
                            </td>
                            <td class="p-3 font-medium">{{ $log->model }}</td>
                            <td class="p-3">{{ $log->description }}</td>
                            <td class="p-3">{{ $log->created_at->format('H:i:s D M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $logs->links() }}

    </div>
</x-app-layout>
