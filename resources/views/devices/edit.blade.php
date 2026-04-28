<x-app-layout>
    <x-slot name="header">
        <h2>Edit Device</h2>
    </x-slot>

    <div class="p-6 max-w-xl mx-auto">

        <x-device.form
            :action="route('devices.update', $device)"
            method="PUT"
            :device="$device"
            button="Update Device"
        />

    </div>
</x-app-layout>
