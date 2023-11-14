<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Shipping Address') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mx-auto bg-white rounded p-6" x-data="shippingAddressForm()">
                        <div class="mb-4">
                            <label for="label" class="block text-gray-700 text-sm font-bold mb-2">Label</label>
                            <input type="text" id="label" name="label" class="w-full border rounded p-2">
                        </div>

                        <div class="mb-4">
                            <label for="recipient" class="block text-gray-700 text-sm font-bold mb-2">Recipient Name</label>
                            <input type="text" id="recipient" name="recipient" class="w-full border rounded p-2">
                        </div>

                        <div class="mb-4">
                            <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Address</label>
                            <textarea id="address" name="address" rows="4" class="w-full border rounded p-2"></textarea>
                        </div>

                        <div class="mb-4 grid lg:grid-cols-2 gap-4">
                            <div @click.away="subDistrictSuggestionActive=false" @keydown.escape="subDistrictSuggestionActive=false">
                                <label for="subDistrict" class="block text-gray-700 text-sm font-bold mb-2">Sub District</label>
                                <input type="text" id="subDistrict" name="subDistrict" class="w-full border rounded p-2" x-model="subDistrictQuery" @input.debounce.500="updateSubDistrictSuggestion" @focus="subDistrictSuggestionActive=true">
                                <div class="relative" x-show="subDistrictSuggestions.length > 0 && subDistrictSuggestionActive" x-cloak x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-y-90" x-transition:enter-end="opacity-100 transform scale-y-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 transform scale-y-100" x-transition:leave-end="opacity-0 transform scale-y-90">
                                    <div class="absolute top-100 mt-1 w-full border bg-white shadow-xl rounded-xl">
                                        <div class="p-3">
                                            <div class="" x-ref="list">
                                                <template x-for="(suggestion, index) in subDistrictSuggestions" :key="index">
                                                    <a x-bind:active="false"
                                                       x-bind:class="{'p-2 flex block w-full rounded-xl hover:bg-gray-100 cursor-pointer': true}"
                                                       x-on:click="selectSubDistrict(suggestion)">
                                                        <span x-text="suggestion.name + ', ' + suggestion.district.name + ', ' + suggestion.district.city.name + ', ' + suggestion.district.city.province.name"></span>
                                                    </a>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="district" class="block text-gray-700 text-sm font-bold mb-2">District</label>
                                <input type="text" readonly id="district" name="district" class="w-full border rounded p-2" x-model="selectedDistrictName">
                            </div>
                        </div>

                        <div class="mb-4 grid lg:grid-cols-2 gap-4">
                            <div>
                                <label for="city" class="block text-gray-700 text-sm font-bold mb-2">City</label>
                                <input type="text" readonly id="city" name="city" class="w-full border rounded p-2" x-model="selectedCityName">
                            </div>
                            <div>
                                <label for="province" class="block text-gray-700 text-sm font-bold mb-2">Province</label>
                                <input type="text" readonly id="province" name="province" class="w-full border rounded p-2" x-model="selectedProvinceName">
                            </div>
                        </div>

                        <div class="mb-4 grid lg:grid-cols-2 gap-4">
                            <div>
                                <label for="postalCode" class="block text-gray-700 text-sm font-bold mb-2">Postal Code</label>
                                <input type="text" id="postalCode" name="postalCode" class="w-full border rounded p-2">
                            </div>
                            <div>
                                <label for="phoneNumber" class="block text-gray-700 text-sm font-bold mb-2">Phone Number</label>
                                <input type="text" id="phoneNumber" name="phoneNumber" class="w-full border rounded p-2">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="note" class="block text-gray-700 text-sm font-bold mb-2">Note for Courier</label>
                            <textarea id="note" name="note" rows="2" class="w-full border rounded p-2"></textarea>
                        </div>

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function shippingAddressForm() {
            return {
                subDistrictQuery: "",
                subDistrictSuggestionActive: false,
                subDistrictSuggestions: [],
                selectedDistrictName: "",
                selectedCityName: "",
                selectedProvinceName: "",
                updateSubDistrictSuggestion() {
                    if (this.subDistrictQuery === '') {
                        return;
                    }
                    fetch('/api/sub-district/search?query=' + this.subDistrictQuery + '&size=' + 8)
                        .then(response => response.json())
                        .then(data => {
                            console.log(data.map(item => item.name));
                            this.subDistrictSuggestions = data;
                        })
                },
                selectSubDistrict(selected) {
                    this.subDistrictSuggestionActive = false;
                    this.subDistrictQuery = selected.name;
                    this.selectedDistrictName = selected.district.name;
                    this.selectedCityName = selected.district.city.name;
                    this.selectedProvinceName = selected.district.city.province.name;
                }
            }
        }
    </script>
</x-app-layout>
