<form action="{{ route('roles.store') }}" method="POST">
    @csrf
    <input name="name" placeholder="Role name">

    <button>Create</button>
</form>
