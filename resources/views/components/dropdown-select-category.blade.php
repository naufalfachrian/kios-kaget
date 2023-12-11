@props([
    'class',
    'name',
    'max',
])

<x-dropdown-select class="{{ $class }}" name="{{ $name }}">
    <div x-data="dropdownSelectCategory"
         x-init="updateSuggestions"
         @find-category.window="query = $event.detail; updateSuggestions();">
        <template x-for="(suggestion, index) in suggestions" :key="index">
            <a x-bind:active="false"
               x-bind:class="{'p-2 flex w-full rounded-xl hover:bg-gray-100 cursor-pointer': true}"
               x-on:click="$dispatch('category-selected', suggestion)">
                <span>
                    <template x-if="suggestion.group !== null">
                        <span class="bg-green-100 text-sm p-1 rounded-md" x-text="suggestion.group.name"></span>
                    </template>
                    <span x-text="suggestion.name"></span>
                </span>
            </a>
        </template>
    </div>
</x-dropdown-select>

<script>
    function dropdownSelectCategory() {
        return {
            query: "",
            updateSuggestions() {
                let url = '{{ route('categories.search') }}?size=' + {{ $max }};
                if (this.query !== '') {
                    url += '&query=' + this.query;
                }
                fetch(url, {
                    headers: {
                        'x-csrf-token': '{{ csrf_token() }}'
                    }
                }).then(response => response.json())
                    .then(data => {
                            this.$dispatch('update-suggestions', {on: '{{ $name }}', items: data});
                        }
                    );
            }
        }
    }
</script>
