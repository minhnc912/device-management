<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Devices</h2>
    </x-slot>

    <div class="p-6 space-y-4">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded text-sm">
                {{ session('success') }}
            </div>
        @endif
        <div class="flex justify-between items-center">
            <form method="GET" class="flex gap-3">

                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search device..."
                    class="border px-3 py-2 rounded">

                <select name="status" class="border px-3 py-2 rounded">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="maintenance" {{ request('status') == 'maintenance' ? 'selected' : '' }}>Maintenance
                    </option>
                </select>

                <button class="bg-blue-600 text-white px-4 py-2 rounded">
                    Filter
                </button>
                <a href="{{ route('devices.index') }}" class="text-gray-600 underline">
                    Reset
                </a>

            </form>
            @can('devices.create')
                <a href="{{ route('devices.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
                    + Create device
                </a>
            @endcan
        </div>
    </div>

    <div class="mx-6 overflow-x-auto bg-white rounded shadow">

        <table class="w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Name</th>
                    <th class="p-3 text-left">Code</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Location</th>
                    <th class="p-3 text-left">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse  ($devices as $device)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-3 font-medium">{{ $device->name }}</td>
                        <td class="p-3">{{ $device->code }}</td>
                        <td class="p-3">
                            @php
                                $color = match ($device->status) {
                                    'active' => 'bg-green-100 text-green-700',
                                    'inactive' => 'bg-gray-100 text-gray-600',
                                    'maintenance' => 'bg-yellow-100 text-yellow-700',
                                    default => 'bg-gray-100',
                                };
                            @endphp
                            <span class="px-2 py-1 text-xs rounded {{ $color }}">
                                {{ $device->status }}
                            </span>
                        </td>
                        <td class="p-3">{{ $device->location }}</td>
                        <td class="p-3 space-x-2">
                            @can('devices.edit')
                                <a href="{{ route('devices.edit', $device) }}" class="text-blue-600 hover:underline">
                                    Edit
                                </a>
                            @endcan
                            @can('devices.delete')
                                <form action="{{ route('devices.destroy', $device) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline"
                                        onclick="return confirm('Delete this device?')">
                                        Delete
                                    </button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center p-4 text-gray-400">
                            No devices found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">
            {{ $devices->links() }}
        </div>

    </div>
</x-app-layout>
