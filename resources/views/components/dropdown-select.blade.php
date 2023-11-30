@props([
    'class',
    'name',
])


<div x-data="dropdownSelect()" class="{{ $class }}" x-show="suggestions.length > 0 && show" x-cloak
     @open-dropdown.window="$event.detail == '{{ $name }}' ? show = true : null"
     @close-dropdown.window="$event.detail == '{{ $name }}' ? show = false : null"
     @clear-dropdown.window="$event.detail == '{{ $name }}' ? suggestions = [] : null"
     @update-suggestions.window="$event.detail.on == '{{ $name }}' ? suggestions = $event.detail.items : null"
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0 transform scale-y-90"
     x-transition:enter-end="opacity-100 transform scale-y-100"
     x-transition:leave="transition ease-in duration-100"
     x-transition:leave-start="opacity-100 transform scale-y-100"
     x-transition:leave-end="opacity-0 transform scale-y-90">
    <div class="absolute overflow-y-scroll h-auto max-h-96 top-100 mt-1 w-full border bg-white shadow-xl rounded-xl">
        <div class="p-3">
            {{ $slot }}
        </div>
    </div>
</div>

<script>
    function dropdownSelect() {
        return {
            suggestions: [],
            show: false,
        }
    }
</script>
