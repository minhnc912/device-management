@props(['link', 'button' => 'Save'])

<div class="flex justify-center items-center gap-6">
    <a href="{{ route($link) }}" class="bg-white text-black px-4 py-2 rounded hover:bg-white/50">
        ← Back
    </a>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">
        {{ $button }}
    </button>
</div>
