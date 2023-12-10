@props(['click'])

<button type="button" x-data=""
        class="bg-brand-brown shadow-lg rounded-lg py-2 px-4 text-brand-light hover:bg-brand-brown/80 flex gap-2"
        @click.prevent="{{ $click }}">
    {{ $slot }}
</button>
