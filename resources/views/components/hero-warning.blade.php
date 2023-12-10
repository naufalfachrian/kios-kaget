@props(['text'])

<div class="bg-yellow-50 shadow sm:rounded-lg p-4 text-brand-black flex flex-row items-center gap-2">
    <x-heroicons-exclamation-triangle class="h-8 w-8"></x-heroicons-exclamation-triangle>
    <span class="font-medium">{{ $text }}</span>
</div>
