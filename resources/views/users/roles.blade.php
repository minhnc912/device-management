<h2>{{ $user->name }}</h2>

<form method="post">
    @csrf

    @foreach ($roles as $role)
        <div>
            <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                {{ $user->hasRole($role->name) ? 'checked' : '' }}>
            {{ $role->name }}
        </div>
    @endforeach

    <button>Save</button>
</form>
