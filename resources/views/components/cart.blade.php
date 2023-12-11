<div x-data="cart" x-init="fetchCart" class="flex flex-col flex-grow h-full"
     @cart-reload.window="fetchCart">
    <div class="p-6 border-b border-blue-200">
        <span class="text-xl font-semibold">{{ __('Cart') }}</span>
    </div>
    <template x-if="subTotal === 0">
        <div class="p-6 flex flex-col gap-3">
            <span>{{ __('Your cart is empty. Please shop!') }}</span>
        </div>
    </template>
    <div class="grow h-auto overflow-y-scroll p-6 flex flex-col gap-6">
        <template x-for="cartDetail in cartDetails">
            <div class="flex flex-row gap-2 rounded-xl border border-orange-200 p-4">
                <div class="basis-1/4">
                    <template x-if="cartDetail.product.images.length > 0">
                        <img class="basis-1/4 w-auto h-auto rounded-lg" :src="cartDetail.product.images[0].image_url">
                    </template>
                </div>
                <div class="basis-3/4 flex flex-col gap-2 justify-center">
                    <span class="text-xl font-semibold" x-text="cartDetail.product_name"></span>
                    <div class="flex flex-row">
                        <form class="max-w-xs">
                            <div class="relative flex items-center max-w-[8rem]">
                                <button type="button" id="decrement-button" data-input-counter-decrement="quantity-input" class="bg-orange-100 dark:bg-orange-700 dark:hover:bg-orange-600 dark:border-orange-600 hover:bg-orange-200 border border-orange-300 p-3 h-11 focus:ring-orange-100 dark:focus:ring-orang-700 focus:ring-2 focus:outline-none rounded-s-full"
                                        @click="decrease(cartDetail)">
                                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                    </svg>
                                </button>
                                <input type="text" id="quantity-input" data-input-counter class="bg-orange-50 border-x-0 border-orange-300 h-11 text-center text-orange-900 text-sm focus:ring-orange-500 focus:border-orange-500 block w-full py-2.5 dark:bg-orange-700 dark:border-orange-600 dark:placeholder-orange-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500" required
                                       x-model="cartDetail.quantity" @input.debounce.500="updateCartDetail(cartDetail)">
                                <button type="button" id="increment-button" data-input-counter-increment="quantity-input" class="bg-orange-100 dark:bg-orange-700 dark:hover:bg-orange-600 dark:border-orange-600 hover:bg-orange-200 border border-orange-300 p-3 h-11 focus:ring-orange-100 dark:focus:ring-orange-700 focus:ring-2 focus:outline-none rounded-e-full"
                                        @click="increase(cartDetail)">
                                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                    </svg>
                                </button>
                            </div>
                        </form>
                        <span class="text-xl ms-auto my-auto font-semibold text-right"
                              x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(cartDetail.product.price,)"></span>
                    </div>
                    <hr>
                    <div class="flex flex-row-reverse">
                        <span class="text-xl font-semibold"
                              x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(cartDetail.product.price * cartDetail.quantity,)"></span>
                    </div>
                </div>
            </div>
        </template>
    </div>
    <template x-if="subTotal > 0">
        <div class="p-6 border-t border-blue-200 flex flex-col gap-3">
            <div class="flex-row flex">
                <span class="text-xl font-semibold">{{ __('Sub Total') }}</span>
                <span class="text-xl font-semibold ms-auto" x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(subTotal,)"></span>
            </div>
            <a href="{{ route('orders.index') }}" class="btn--primary w-full items-center justify-center h-14"
                    :class="{'cursor-not-allowed': isSubmitting}"
                    :disabled="isSubmitting">
                <svg :hidden="isSubmitting" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z" />
                </svg>
                <svg :hidden="!isSubmitting"
                     class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                     fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span class="text-lg">{{ __('Checkout') }}</span>
            </a>
        </div>
    </template>
</div>

<script>
    function cart() {
        return {
            isSubmitting: false,
            cartDetails: [],
            subTotal: 0,
            fetchCart() {
                this.isSubmitting = true;
                fetch('{{ route('cart-details.index') }}', {
                    headers: {
                        'Accept': 'application/json',
                        'x-csrf-token': '{{ csrf_token() }}',
                        'x-cart-session-id': getSessionId(),
                    }
                }).then(response => {
                    response.json().then(response => {
                        this.cartDetails = response.details;
                        this.subTotal = 0;
                        for (let detail of response.details) {
                            this.subTotal += parseInt(detail.product.price * detail.quantity);
                        }
                        this.isSubmitting = false;
                    })
                });
            },
            increase(cartDetail) {
                cartDetail.quantity += 1;
                this.updateCartDetail(cartDetail);
            },
            decrease(cartDetail) {
                cartDetail.quantity -= 1;
                this.updateCartDetail(cartDetail);
            },
            updateCartDetail(cartDetail) {
                this.isSubmitting = true;
                let formData = new FormData();
                formData.set('product_id', cartDetail.product_id);
                formData.set('quantity_set', cartDetail.quantity);
                fetch("{{ route('cart-details.store') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                        'x-csrf-token': '{{ csrf_token() }}',
                        'x-cart-session-id': getSessionId(),
                    }
                }).then(response => {
                    console.log(response);
                    this.fetchCart();
                    this.isSubmitting = false;
                });
            }
        }
    }
</script>
