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
                    <div class="mx-auto bg-white rounded p-6">
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
                            <div>
                                <label for="subDistrict" class="block text-gray-700 text-sm font-bold mb-2">Sub District</label>
                                <input type="text" id="subDistrict" name="subDistrict" class="w-full border rounded p-2">
                            </div>
                            <div>
                                <label for="district" class="block text-gray-700 text-sm font-bold mb-2">District</label>
                                <input type="text" id="district" name="district" class="w-full border rounded p-2">
                            </div>
                        </div>

                        <div class="mb-4 grid lg:grid-cols-2 gap-4">
                            <div>
                                <label for="city" class="block text-gray-700 text-sm font-bold mb-2">City</label>
                                <input type="text" id="city" name="city" class="w-full border rounded p-2">
                            </div>
                            <div>
                                <label for="province" class="block text-gray-700 text-sm font-bold mb-2">Province</label>
                                <input type="text" id="province" name="province" class="w-full border rounded p-2">
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
</x-app-layout>
