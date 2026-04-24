<h1>Roles</h1>

<a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">Create Role</a>

@foreach ($roles as $role)
    <div>
        <h2>{{ $role->name }}</h2>
        <a href="/roles/{{ $role->id }}/permissions">Permissions</a>
    </div>
@endforeach
