@props([
    'name',
    'show' => false,
    'maxWidth' => '2xl',
    'from' => 'top'
])

@php
$maxWidth = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
][$maxWidth];
@endphp

<div
    x-data="{
        show: @js($show),
        focusables() {
            // All focusable element types...
            let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'
            return [...$el.querySelectorAll(selector)]
                // All non-disabled elements...
                .filter(el => ! el.hasAttribute('disabled'))
        },
        firstFocusable() { return this.focusables()[0] },
        lastFocusable() { return this.focusables().slice(-1)[0] },
        nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
        prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
        nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
        prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) -1 },
    }"
    x-init="$watch('show', value => {
        if (value) {
            document.body.classList.add('overflow-y-hidden');
            {{ $attributes->has('focusable') ? 'setTimeout(() => firstFocusable().focus(), 100)' : '' }}
        } else {
            document.body.classList.remove('overflow-y-hidden');
        }
    })"
    x-on:open-modal.window="$event.detail == '{{ $name }}' ? show = true : null"
    x-on:close.stop="show = false"
    x-on:close.window="show = false"
    x-on:keydown.escape.window="show = false"
    x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
    x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
    x-show="show"
    class="{{ $from === 'top' ? 'fixed inset-0 overflow-y-auto px-4 py-0 sm:px-0' : ($from === 'end' ? 'absolute end-0 top-0 bottom-0 inset-0 h-full' : '') }} z-50"
    style="display: {{ $show ? 'block' : 'none' }};"
>
    <div
        x-show="show"
        class="fixed inset-0 transform transition-all"
        x-on:click="show = false"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-80"></div>
    </div>

    <div
        x-show="show"
        class="{{ $from === 'top' ? 'rounded-b-3xl sm:mx-auto' : ($from === 'end' ? 'h-full rounded-s-3xl sm:mx-auto sm:me-0' : '') }} mb-6 bg-white dark:bg-gray-800 overflow-hidden shadow-xl transform transition-all sm:w-full {{ $maxWidth }}"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="{{ $from === 'top' ? '-translate-y-12' : ($from === 'end' ? 'translate-x-12' : '') }} opacity-0"
        x-transition:enter-end="{{ $from === 'top' ? 'translate-y-0' : ($from === 'end' ? 'translate-x-0' : '') }} opacity-100 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="{{ $from === 'top' ? 'translate-y-0' : ($from === 'end' ? 'translate-x-0' : '') }} opacity-100 sm:scale-100"
        x-transition:leave-end="{{ $from === 'top' ? '-translate-y-12' : ($from === 'end' ? 'translate-x-12' : '') }} opacity-0"
    >
        {{ $slot }}
    </div>
</div>
