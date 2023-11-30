@props([
    'class',
    'name',
    'max',
])

<x-dropdown-select class="{{ $class }}" name="{{ $name }}">
    <div x-data="dropdownSelectSubDistrict"
         @find-sub-district.window="query = $event.detail; updateSuggestions();">
        <template x-for="(suggestion, index) in suggestions" :key="index">
            <a x-bind:active="false"
               x-bind:class="{'p-2 flex w-full rounded-xl hover:bg-gray-100 cursor-pointer': true}"
               x-on:click="$dispatch('sub-district-selected', suggestion)">
                <span x-text="suggestion.name + ', ' + suggestion.district.name + ', ' + suggestion.district.city.name + ', ' + suggestion.district.city.province.name"></span>
            </a>
        </template>
    </div>
</x-dropdown-select>

<script>
    function dropdownSelectSubDistrict() {
        return {
            query: "",
            updateSuggestions() {
                if (this.query === '') {
                    this.$dispatch('update-suggestions', {on: '{{ $name }}', items: []});
                    return;
                }
                fetch('/api/sub-districts/search?query=' + this.query + '&size=' + {{ $max }})
                    .then(response => response.json())
                    .then(data => {
                        this.$dispatch('update-suggestions', {on: '{{ $name }}', items: data});
                    }
                );
            },
        }
    }
</script>
