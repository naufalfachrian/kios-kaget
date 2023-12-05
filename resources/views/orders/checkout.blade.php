<x-app-layout>
    <form class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8" x-data="checkoutForm" method="post" action="{{ route('orders.store') }}"
         @sub-district-selected.window="subDistrictSelected($event.detail)"
         @postal-code-selected.window="postalCodeSelected($event.detail)">
        @csrf
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        <input hidden="" name="session_id" x-model="sessionId">
        <div class="grid lg:grid-cols-2">
            <div class="flex flex-col p-6 border-orange-200 rounded-xl border-2 shadow-xl backdrop-blur">
                <h2 class="font-bold text-xl mb-4">{{ __('Contact') }}</h2>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm mb-1">Email *</label>
                    <input type="email" id="email" name="email" class="w-full border rounded p-2">
                </div>

                <h2 class="font-bold text-xl mb-4 mt-4">{{ __('Delivery') }}</h2>

                <div class="mb-4">
                    <label for="recipient_name" class="block text-gray-700 text-sm font mb-1">Recipient Name *</label>
                    <input type="text" id="recipient_name" name="recipient_name" class="w-full border rounded p-2" value="{{ isset($shippingAddress) ? $shippingAddress->recipient_name : old('recipient_name') }}">
                </div>

                <div class="mb-4">
                    <label for="address" class="block text-gray-700 text-sm mb-1">Address *</label>
                    <textarea id="address" name="address" rows="4" class="w-full border rounded p-2">{{ isset($shippingAddress) ? $shippingAddress->address : old('address') }}</textarea>
                </div>

                <div class="mb-4">
                    <div @click.away="$dispatch('close-dropdown', 'select-sub-district')" @keydown.escape="$dispatch('close-dropdown', 'select-sub-district')">
                        <label for="subDistrict" class="block text-gray-700 text-sm mb-1">Sub District *</label>
                        <input type="text" id="subDistrict" name="subDistrict" class="w-full border rounded p-2" x-model="subDistrictQuery"
                               @input="resetSubDistrict"
                               @input.debounce.500="$dispatch('find-sub-district', $el.value)"
                               @focus="$dispatch('open-dropdown', 'select-sub-district');$dispatch('close-dropdown', 'select-postal-code')">
                        <x-dropdown-select-sub-district class="relative" name="select-sub-district" max="80"></x-dropdown-select-sub-district>
                    </div>
                </div>

                <div class="mb-4 grid lg:grid-cols-2 gap-4">
                    <div>
                        <label for="district" class="block text-gray-700 text-sm mb-1">District *</label>
                        <input type="text" readonly id="district" name="district" class="w-full border rounded p-2" x-model="selectedDistrictName">
                    </div>
                    <div>
                        <label for="city" class="block text-gray-700 text-sm mb-1">City *</label>
                        <input type="text" readonly id="city" name="city" class="w-full border rounded p-2" x-model="selectedCityName">
                    </div>
                </div>

                <div class="mb-4">
                    <div>
                        <label for="province" class="block text-gray-700 text-sm mb-1">Province *</label>
                        <input type="text" readonly id="province" name="province" class="w-full border rounded p-2" x-model="selectedProvinceName">
                    </div>
                </div>

                <div class="mb-4 grid lg:grid-cols-2 gap-4">
                    <div @click.away="$dispatch('close-dropdown', 'select-postal-code')" @keydown.escape="$dispatch('close-dropdown', 'select-postal-code')">
                        <label for="postalCode" class="block text-gray-700 text-sm mb-1">Postal Code *</label>
                        <input type="text" id="postalCode" name="postal_code" class="w-full border rounded p-2" x-model="inputPostalCode" @focus="$dispatch('close-dropdown', 'select-sub-district');$dispatch('open-dropdown', 'select-postal-code')">
                        <x-dropdown-select-postal-code class="relative" name="select-postal-code"></x-dropdown-select-postal-code>
                    </div>
                    <div>
                        <label for="phoneNumber" class="block text-gray-700 text-sm mb-1">Phone Number *</label>
                        <input type="tel" id="phoneNumber" name="phone_number" class="w-full border rounded p-2" value="{{ isset($shippingAddress) ? $shippingAddress->phone_number : old('phone_number') }}">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="landmark" class="block text-gray-700 text-sm mb-1">Note for Courier</label>
                    <textarea id="landmark" name="landmark" rows="2" class="w-full border rounded p-2">{{ isset($shippingAddress) ? $shippingAddress->landmark : old('landmark') }}</textarea>
                </div>

                <button type="submit" class="btn--primary w-full items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z" />
                    </svg>
                    {{ __('Continue to Payment') }}
                </button>

                <input type="hidden" name="sub_district_id" x-model="selectedSubDistrictId"/>
                <input type="hidden" name="district_id" x-model="selectedDistrictId"/>
                <input type="hidden" name="city_id" x-model="selectedCityId"/>
                <input type="hidden" name="province_id" x-model="selectedProvinceId"/>
            </div>
            <div class="ps-6 pe-6">
                <x-cart-checkout></x-cart-checkout>
            </div>
        </div>
    </form>

    <script>
        function checkoutForm() {
            return {
                subDistrictQuery: "{{ isset($shippingAddress) ? $shippingAddress->subDistrict->name : old('subDistrict') }}",
                selectedDistrictName: "{{ isset($shippingAddress) ? $shippingAddress->district->name : old('district') }}",
                selectedCityName: "{{ isset($shippingAddress) ? $shippingAddress->city->name : old('city') }}",
                selectedProvinceName: "{{ isset($shippingAddress) ? $shippingAddress->province->name : old('province') }}",
                selectedSubDistrictId: "{{ isset($shippingAddress) ? $shippingAddress->sub_district_id : old('sub_district_id') }}",
                selectedDistrictId: "{{ isset($shippingAddress) ? $shippingAddress->district_id : old('district_id') }}",
                selectedCityId: "{{ isset($shippingAddress) ? $shippingAddress->city_id : old('city_id') }}",
                selectedProvinceId: "{{ isset($shippingAddress) ? $shippingAddress->province_id : old('province_id') }}",
                inputPostalCode: "{{ isset($shippingAddress) ? $shippingAddress->postal_code : old('postal_code') }}",
                sessionId: getSessionId(),
                subDistrictSelected(selected) {
                    console.log(selected);
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
                    this.$dispatch('find-postal-code-by-sub-district-id', this.selectedSubDistrictId);
                },
                postalCodeSelected(selectedPostalCode) {
                    this.$dispatch('close-dropdown', 'select-postal-code');
                    this.inputPostalCode = selectedPostalCode.postal_code;
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
                    this.$dispatch('clear-dropdown', 'select-postal-code');
                }
            }
        }
    </script>
</x-app-layout>
