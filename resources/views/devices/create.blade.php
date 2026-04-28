<x-app-layout>
    <x-slot name="header">
        <h2>Create Device</h2>
    </x-slot>

    <div class="p-6 max-w-xl mx-auto">

        <x-device.form
            :action="route('devices.store')"
            method="POST"
            button="Create Device"
        />

    </div>
</x-app-layout>
