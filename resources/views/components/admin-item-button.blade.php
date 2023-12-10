@props([
    'edit',
    'delete',
])

<div class="absolute end-0 top-0 mt-2 me-2 flex shadow-lg rounded-lg">
    <button class="bg-yellow-500/80 backdrop-blur-xl hover:bg-yellow-500/60 p-2 rounded-s-lg text-white"
            x-on:click.prevent="{{ $edit }}">
        <x-heroicons-pencil class="w-5 h-5"></x-heroicons-pencil>
    </button>
    <button class="bg-red-500/80 backdrop-blur-xl hover:bg-red-500/60 p-2 rounded-e-lg text-white"
            x-on:click.prevent="{{ $delete }}">
        <x-heroicons-trash class="w-5 h-5"></x-heroicons-trash>
    </button>
</div>
