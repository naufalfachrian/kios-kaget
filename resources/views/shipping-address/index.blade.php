<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Shipping Address') }}
        </h2>
        <x-primary-button-link class="ml-auto" href="{{ route('shipping-addresses.create') }}"
                         x-data="">
            {{ __('Add Shipping Address') }}
        </x-primary-button-link>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(count($shippingAddresses) == 0)
                        <span>You don't have shipping address</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
