@props(['action', 'method' => 'POST', 'role' => null, 'button' => 'Save'])

<form method="POST" action="{{ $action }}" class="space-y-4">
    @csrf

    @if ($method !== 'POST')
        @method($method)
    @endif

    <div>
        <label class="block mb-1">Role Name</label>

        <input type="text" name="name" value="{{ old('name', $role->name ?? '') }}" placeholder="Enter role name"
            class="border rounded px-3 py-2 w-full">

        @error('name')
            <div class="text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <x-form.action-button link="roles.index" :button="$button" />
</form>
