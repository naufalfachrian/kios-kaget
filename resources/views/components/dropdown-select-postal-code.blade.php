@props([
    'class',
    'name',
])

<div x-data="dropdownSelectPostalCode" class="{{ $class }}" x-show="suggestions.length > 0 && show" x-cloak
     @open-dropdown.window="$event.detail == '{{ $name }}' ? show = true : null"
     @close-dropdown.window="$event.detail == '{{ $name }}' ? show = false : null"
     @clear-dropdown.window="$event.detail == '{{ $name }}' ? suggestions = [] : null"
     @find-postal-code-by-sub-district-id.window="findPostalCodeBySubDistrictId($event.detail)"
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
                       x-on:click="$dispatch('postal-code-selected', suggestion)">
                        <span x-text="suggestion.postal_code"></span>
                    </a>
                </template>
            </div>
        </div>
    </div>
</div>

<script>
    function dropdownSelectPostalCode() {
        return {
            suggestions: [],
            show: false,
            findPostalCodeBySubDistrictId(subDistrictId) {
                fetch('/api/postal-codes/search?sub_district_id=' + subDistrictId)
                    .then(response => response.json())
                    .then(data => {
                        this.suggestions = data;
                        if (data.length === 1) {
                            this.$dispatch('postal-code-selected', data[0]);
                        }
                    }
                );
            }
        }
    }
</script>
