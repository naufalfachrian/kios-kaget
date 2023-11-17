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
            @if(count($shippingAddresses) == 0)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <span>You don't have shipping address</span>
                </div>
            </div>
            @else
                <div class="gap-4 grid lg:grid-cols-2">
                    @foreach($shippingAddresses as $shippingAddress)
                        <div class="bg-white shadow sm:rounded-lg p-6 flex flex-col">
                            <div>
                                <span class="text-sm bg-green-500 grow-0 rounded-lg p-1 text-white">
                                    {{ $shippingAddress->label }}
                                </span>
                            </div>
                            <span class="text-lg font-semibold">
                                {{ $shippingAddress->recipient_name }}
                            </span>
                            <span>
                                {{ $shippingAddress->address }}
                            </span>
                            <span>
                                {{ $shippingAddress->subDistrict->name }}, {{ $shippingAddress->district->name }}, {{ $shippingAddress->city->name }}
                            </span>
                            <span>
                                {{ $shippingAddress->province->name }} {{ $shippingAddress->postal_code }}
                            </span>
                            <span>
                                {{ $shippingAddress->phone_number }}
                            </span>
                            <span class="text-sm italic">
                                {{ $shippingAddress->landmark }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
