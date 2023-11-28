<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Shipping Address') }}
        </h2>
        @if($isAbleToAddShippingAddress)
        <a class="btn--primary ml-auto" href="{{ route('shipping-addresses.create') }}"
                               x-data="">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z" />
            </svg>
            {{ __('New Shipping Address') }}
        </a>
        @endif
    </x-slot>

    <div class="py-12" x-data="deleteShippingAddressForm()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 gap-4 flex flex-col">
            @if(count($shippingAddresses) == 0)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <span>You don't have shipping address</span>
                </div>
            </div>
            @else
                @if(!$isAbleToAddShippingAddress)
                <div class="bg-blue-500 shadow sm:rounded-lg">
                    <div class="p-4 text-white flex flex-row gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                        </svg>
                        <span>You have used all of your shipping address slot.</span>
                    </div>
                </div>
                @endif
                <div class="gap-4 grid lg:grid-cols-2">
                    @foreach($shippingAddresses as $shippingAddress)
                        <div class="bg-white shadow sm:rounded-lg p-6 relative">
                            <div class="absolute right-0 top-0 mt-4 mr-4 gap-1.5 flex">
                                <a class="shadow-lg hover:shadow bg-amber-500 hover:bg-amber-600 p-2 rounded-lg text-white" href="{{ route('shipping-addresses.edit', ['shipping_address'=>$shippingAddress->id]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                    </svg>
                                </a>
                                <button class="shadow-lg hover:shadow bg-red-500 hover:bg-red-600 p-2 rounded-lg text-white"
                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-shipping-address-deletion'); confirmDeleteShippingAddress('{{json_encode($shippingAddress)}}'); action = '{{ route('shipping-addresses.destroy', ['shipping_address' => $shippingAddress->id]) }}'">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                            <div class="flex flex-col">
                                <div>
                                    <span class="text-sm bg-green-500 grow-0 rounded p-1 text-white">
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
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <x-modal name="confirm-shipping-address-deletion" focusable>
            <form method="post" x-ref="form" class="p-6" :action="action">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Are you sure you want to delete this shipping address?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Once your shipping address is deleted, it will be permanently deleted. Your shipping addresses used on transactions will still be saved.') }}
                </p>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button class="ms-3">
                        {{ __('Delete') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    </div>

    <script>
        function deleteShippingAddressForm() {
            return {
                shippingAddress: null,
                action: null,
                confirmDeleteShippingAddress(shippingAddress) {
                    this.shippingAddress = shippingAddress;
                }
            }
        }
    </script>
</x-app-layout>
