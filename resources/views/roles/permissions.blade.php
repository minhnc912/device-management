<h2>{{ $role->name }}</h2>

<form method="post">
    @csrf

    @foreach ($permissions as $permission)
        <div>
            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
            {{ $permission->name }}
        </div>
    @endforeach

    <button>Save</button>
</form>
