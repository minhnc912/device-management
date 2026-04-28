<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Create Role
        </h2>
    </x-slot>

    <div class="p-6 max-w-xl mx-auto">

        <x-role.form :action="route('roles.store')" method="POST" button="Create Role" />

    </div>
</x-app-layout>
