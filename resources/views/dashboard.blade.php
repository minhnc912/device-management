<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Dashboard</h2>
    </x-slot>

    <div class="p-6 grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white p-4 rounded shadow">
            <div class="text-gray-500 text-sm">Total Devices</div>
            <div class="text-2xl font-bold">{{ $totalDevices }}</div>
        </div>

        <div class="bg-green-50 p-4 rounded shadow">
            <div class="text-green-600 text-sm">Active</div>
            <div class="text-2xl font-bold">{{ $activeDevices }}</div>
        </div>

        <div class="bg-gray-100 p-4 rounded shadow">
            <div class="text-gray-600 text-sm">Inactive</div>
            <div class="text-2xl font-bold">{{ $inactiveDevices }}</div>
        </div>

        <div class="bg-yellow-50 p-4 rounded shadow">
            <div class="text-yellow-600 text-sm">Maintenance</div>
            <div class="text-2xl font-bold">{{ $maintenanceDevices }}</div>
        </div>

    </div>

    <div class="px-6">
        <div class="bg-white p-4 rounded shadow">
            <div class="text-gray-500 text-sm">Total Users</div>
            <div class="text-2xl font-bold">{{ $totalUsers }}</div>
        </div>
    </div>

    <div class="p-6">
        <div class="bg-white rounded shadow">

            <div class="p-4 border-b font-semibold">
                Recent Activity
            </div>

            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left">User</th>
                        <th class="p-3 text-left">Action</th>
                        <th class="p-3 text-left">Description</th>
                        <th class="p-3 text-left">Time</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($recentLogs as $log)
                        <tr class="border-t">
                            <td class="p-3">{{ $log->user->name }}</td>

                            @php
                                $color = match ($log->action) {
                                    'create' => 'text-green-600',
                                    'update' => 'text-blue-600',
                                    'delete' => 'text-red-600',
                                    default => 'text-gray-600',
                                };
                            @endphp

                            <td class="p-3 {{ $color }}">
                                {{ strtoupper($log->action) }}
                            </td>

                            <td class="p-3">{{ $log->description }}</td>

                            <td class="p-3 text-gray-500">
                                {{ $log->created_at->diffForHumans() }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</x-app-layout>
