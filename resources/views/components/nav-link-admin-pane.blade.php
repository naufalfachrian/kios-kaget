@props([
    'link',
    'label',
    'selected' => false
])

<a class="rounded-xl px-4 py-2 flex-auto flex gap-3 items-center mb-2 {{ $selected ? 'bg-brand-black text-brand-light' : 'text-brand-black hover:text-brand-brown hover:bg-brand-light/80' }}" href="{{ $link }}">
    {{ $icon }}
    <span class="text-sm">
        {{ $label }}
    </span>
</a>
