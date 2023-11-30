@props([
    'class',
    'name',
    'max',
])


<div x-data="dropdownSelectSubDistrict()" class="{{ $class }}" x-show="suggestions.length > 0 && show" x-cloak
     @open-dropdown.window="$event.detail == '{{ $name }}' ? show = true : null"
     @close-dropdown.window="$event.detail == '{{ $name }}' ? show = false : null"
     @find-sub-district.window="query = $event.detail; updateSuggestions();"
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0 transform scale-y-90"
     x-transition:enter-end="opacity-100 transform scale-y-100"
     x-transition:leave="transition ease-in duration-100"
     x-transition:leave-start="opacity-100 transform scale-y-100"
     x-transition:leave-end="opacity-0 transform scale-y-90">
    <div class="absolute overflow-y-scroll h-auto max-h-96 top-100 mt-1 w-full border bg-white shadow-xl rounded-xl">
        <div class="p-3">
            <div class="" x-ref="list">
                <template x-for="(suggestion, index) in suggestions" :key="index">
                    <a x-bind:active="false"
                       x-bind:class="{'p-2 flex block w-full rounded-xl hover:bg-gray-100 cursor-pointer': true}"
                       x-on:click="$dispatch('sub-district-selected', suggestion)">
                        <span x-text="suggestion.name + ', ' + suggestion.district.name + ', ' + suggestion.district.city.name + ', ' + suggestion.district.city.province.name"></span>
                    </a>
                </template>
            </div>
        </div>
    </div>
</div>

<script>
    function dropdownSelectSubDistrict() {
        return {
            suggestions: [],
            show: false,
            query: "",
            updateSuggestions() {
                if (this.query === '') {
                    this.suggestions = [];
                    return;
                }
                fetch('/api/sub-districts/search?query=' + this.query + '&size=' + {{ $max }})
                    .then(response => response.json())
                    .then(data => {
                        this.suggestions = data;
                    }
                );
            },
        }
    }
</script>
