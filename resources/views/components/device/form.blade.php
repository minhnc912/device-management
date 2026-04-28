@props(['action', 'method' => 'POST', 'device' => null, 'button' => 'Save'])

<form method="POST" action="{{ $action }}" class="space-y-4">
    @csrf

    @if ($method !== 'POST')
        @method($method)
    @endif
    <div>
        <label>Name</label>
        <input name="name" value="{{ old('name', $device->name ?? '') }}" class="border w-full px-3 py-2 rounded">

        @error('name')
            <div class="text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label>Code</label>
        <input name="code" value="{{ old('code', $device->code ?? '') }}" class="border w-full px-3 py-2 rounded">

        @error('code')
            <div class="text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label>Status</label>

        <select name="status" class="border w-full px-3 py-2 rounded">
            @foreach (['active', 'inactive', 'maintenance'] as $s)
                <option value="{{ $s }}" {{ old('status', $device->status ?? '') == $s ? 'selected' : '' }}>
                    {{ ucfirst($s) }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Location</label>
        <input name="location" value="{{ old('location', $device->location ?? '') }}"
            class="border w-full px-3 py-2 rounded">
    </div>

    <x-form.action-button link="devices.index" :button="$button" />
</form>
