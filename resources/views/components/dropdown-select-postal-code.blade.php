@props([
    'class',
    'name',
])

<x-dropdown-select class="{{ $class }}" name="{{ $name }}">
    <div x-data="dropdownSelectPostalCode"
         @find-postal-code-by-sub-district-id.window="findPostalCodeBySubDistrictId($event.detail)">
        <template x-for="(suggestion, index) in suggestions" :key="index">
            <a x-bind:active="false"
               x-bind:class="{'p-2 flex block w-full rounded-xl hover:bg-gray-100 cursor-pointer': true}"
               x-on:click="$dispatch('postal-code-selected', suggestion)">
                <span x-text="suggestion.postal_code"></span>
            </a>
        </template>
    </div>
</x-dropdown-select>

<script>
    function dropdownSelectPostalCode() {
        return {
            findPostalCodeBySubDistrictId(subDistrictId) {
                fetch('/api/postal-codes/search?sub_district_id=' + subDistrictId)
                    .then(response => response.json())
                    .then(data => {
                        this.$dispatch('update-suggestions', {on: '{{ $name }}', items: data});
                        if (data.length === 1) {
                            this.$dispatch('postal-code-selected', data[0]);
                        }
                    }
                );
            }
        }
    }
</script>
