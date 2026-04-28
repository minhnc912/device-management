<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Edit Role: {{ $role->name }}
        </h2>
    </x-slot>

    <div class="p-6 max-w-xl mx-auto">

        <x-role.form :action="route('roles.update', $role)" method="PUT" :role="$role" button="Update Role" />

    </div>
</x-app-layout>
