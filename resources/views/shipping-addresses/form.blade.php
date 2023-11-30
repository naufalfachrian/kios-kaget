<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($shippingAddress) ? __('Edit Shipping Address') : __('Create New Shipping Address') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form class="mx-auto bg-white rounded p-6" x-data="shippingAddressForm()"
                          @sub-district-selected.window="subDistrictSelected($event.detail)"
                          action="{{ isset($shippingAddress) ? route('shipping-addresses.update', ['shipping_address' => $shippingAddress->id]) : route('shipping-addresses.store') }}"
                          method="post">
                        @if ($errors->any())
                            <div class="bg-red-200 p-4 rounded-xl mb-8">
                                <h2 class="font-semibold text-xl leading-tight">{{__('Failed to save new shipping address')}}</h2>
                                <ol class="list-decimal ms-8">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ol>
                            </div>
                        @endif
                        @if(isset($shippingAddress))
                            @method('PATCH')
                        @endif
                        @csrf
                        <div class="mb-4">
                            <label for="label" class="block text-gray-700 text-sm font-bold mb-2">Label *</label>
                            <input type="text" id="label" name="label" class="w-full border rounded p-2" value="{{ isset($shippingAddress) ? $shippingAddress->label : old('label') }}">
                        </div>

                        <div class="mb-4">
                            <label for="recipient" class="block text-gray-700 text-sm font-bold mb-2">Recipient Name *</label>
                            <input type="text" id="recipient" name="recipient_name" class="w-full border rounded p-2" value="{{ isset($shippingAddress) ? $shippingAddress->recipient_name : old('recipient_name') }}">
                        </div>

                        <div class="mb-4">
                            <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Address *</label>
                            <textarea id="address" name="address" rows="4" class="w-full border rounded p-2">{{ isset($shippingAddress) ? $shippingAddress->address : old('address') }}</textarea>
                        </div>

                        <div class="mb-4 grid lg:grid-cols-2 gap-4">
                            <div @click.away="$dispatch('close-dropdown', 'select-sub-district')" @keydown.escape="$dispatch('close-dropdown', 'select-sub-district')">
                                <label for="subDistrict" class="block text-gray-700 text-sm font-bold mb-2">Sub District *</label>
                                <input type="text" id="subDistrict" name="subDistrict" class="w-full border rounded p-2" x-model="subDistrictQuery"
                                       @input="resetSubDistrict"
                                       @input.debounce.500="$dispatch('find-sub-district', $el.value)"
                                       @focus="$dispatch('open-dropdown', 'select-sub-district');postalCodeSuggestionActive=false">
                                <x-dropdown-select-sub-district class="relative" name="select-sub-district" max="80"></x-dropdown-select-sub-district>
                            </div>
                            <div>
                                <label for="district" class="block text-gray-700 text-sm font-bold mb-2">District *</label>
                                <input type="text" readonly id="district" name="district" class="w-full border rounded p-2" x-model="selectedDistrictName">
                            </div>
                        </div>

                        <div class="mb-4 grid lg:grid-cols-2 gap-4">
                            <div>
                                <label for="city" class="block text-gray-700 text-sm font-bold mb-2">City *</label>
                                <input type="text" readonly id="city" name="city" class="w-full border rounded p-2" x-model="selectedCityName">
                            </div>
                            <div>
                                <label for="province" class="block text-gray-700 text-sm font-bold mb-2">Province *</label>
                                <input type="text" readonly id="province" name="province" class="w-full border rounded p-2" x-model="selectedProvinceName">
                            </div>
                        </div>

                        <div class="mb-4 grid lg:grid-cols-2 gap-4">
                            <div @click.away="postalCodeSuggestionActive=false" @keydown.escape="postalCodeSuggestionActive=false">
                                <label for="postalCode" class="block text-gray-700 text-sm font-bold mb-2">Postal Code *</label>
                                <input type="text" id="postalCode" name="postal_code" class="w-full border rounded p-2" x-model="inputPostalCode" @focus="$dispatch('close-dropdown', 'select-sub-district');postalCodeSuggestionActive=true">
                                <div class="relative" x-show="postalCodeSuggestions.length > 0 && postalCodeSuggestionActive" x-cloak x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-y-90" x-transition:enter-end="opacity-100 transform scale-y-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 transform scale-y-100" x-transition:leave-end="opacity-0 transform scale-y-90">
                                    <div class="absolute overflow-y-scroll h-auto max-h-96 top-100 mt-1 w-full border bg-white shadow-xl rounded-xl">
                                        <div class="p-3">
                                            <div class="" x-ref="list">
                                                <template x-for="(suggestion, index) in postalCodeSuggestions" :key="index">
                                                    <a x-bind:active="false"
                                                       x-bind:class="{'p-2 flex block w-full rounded-xl hover:bg-gray-100 cursor-pointer': true}"
                                                       x-on:click="selectPostalCode(suggestion)">
                                                        <span x-text="suggestion.postal_code"></span>
                                                    </a>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="phoneNumber" class="block text-gray-700 text-sm font-bold mb-2">Phone Number *</label>
                                <input type="tel" id="phoneNumber" name="phone_number" class="w-full border rounded p-2" value="{{ isset($shippingAddress) ? $shippingAddress->phone_number : old('phone_number') }}">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="landmark" class="block text-gray-700 text-sm font-bold mb-2">Note for Courier</label>
                            <textarea id="landmark" name="landmark" rows="2" class="w-full border rounded p-2">{{ isset($shippingAddress) ? $shippingAddress->landmark : old('landmark') }}</textarea>
                        </div>

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>

                        <input type="hidden" name="sub_district_id" x-model="selectedSubDistrictId"/>
                        <input type="hidden" name="district_id" x-model="selectedDistrictId"/>
                        <input type="hidden" name="city_id" x-model="selectedCityId"/>
                        <input type="hidden" name="province_id" x-model="selectedProvinceId"/>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function shippingAddressForm() {
            return {
                subDistrictQuery: "{{ isset($shippingAddress) ? $shippingAddress->subDistrict->name : old('subDistrict') }}",
                postalCodeSuggestionActive: false,
                postalCodeSuggestions: [],
                selectedDistrictName: "{{ isset($shippingAddress) ? $shippingAddress->district->name : old('district') }}",
                selectedCityName: "{{ isset($shippingAddress) ? $shippingAddress->city->name : old('city') }}",
                selectedProvinceName: "{{ isset($shippingAddress) ? $shippingAddress->province->name : old('province') }}",
                selectedSubDistrictId: "{{ isset($shippingAddress) ? $shippingAddress->sub_district_id : old('sub_district_id') }}",
                selectedDistrictId: "{{ isset($shippingAddress) ? $shippingAddress->district_id : old('district_id') }}",
                selectedCityId: "{{ isset($shippingAddress) ? $shippingAddress->city_id : old('city_id') }}",
                selectedProvinceId: "{{ isset($shippingAddress) ? $shippingAddress->province_id : old('province_id') }}",
                inputPostalCode: "{{ isset($shippingAddress) ? $shippingAddress->postal_code : old('postal_code') }}",
                subDistrictSelected(selected) {
                    if (this.selectedSubDistrictId !== selected.id) {
                        this.inputPostalCode = "";
                    }
                    this.$dispatch('close-dropdown', 'select-sub-district');
                    this.subDistrictQuery = selected.name;
                    this.selectedDistrictName = selected.district.name;
                    this.selectedCityName = selected.district.city.name;
                    this.selectedProvinceName = selected.district.city.province.name;
                    this.selectedSubDistrictId = selected.id;
                    this.selectedDistrictId = selected.district.id;
                    this.selectedCityId = selected.district.city.id;
                    this.selectedProvinceId = selected.district.city.province.id;
                    fetch('/api/postal-codes/search?sub_district_id=' + this.selectedSubDistrictId)
                        .then(response => response.json())
                        .then(data => {
                            this.postalCodeSuggestions = data;
                            if (data.length === 1) {
                                this.selectPostalCode(data[0]);
                            }
                        })
                },
                selectPostalCode(selected) {
                    this.postalCodeSuggestionActive = false;
                    this.inputPostalCode = selected.postal_code;
                },
                resetSubDistrict() {
                    this.selectedDistrictName = "";
                    this.selectedCityName = "";
                    this.selectedProvinceName = "";
                    this.inputPostalCode = "";
                    this.selectedSubDistrictId = null;
                    this.selectedDistrictId = null;
                    this.selectedCityId = null;
                    this.selectedProvinceId = null;
                }
            }
        }
    </script>
</x-app-layout>
