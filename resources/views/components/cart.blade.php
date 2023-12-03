<div x-data="cart" x-init="fetchCart" class="flex flex-col flex-grow h-full"
     @cart-reload.window="fetchCart">
    <div class="p-6 border-b border-blue-200">
        <span class="text-xl font-semibold">{{ __('Cart') }}</span>
    </div>
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
                        <span class="text-xl basis-1/2" x-text="cartDetail.quantity"></span>
                        <span class="text-xl basis-1/2 font-semibold text-right"
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
    <div class="p-6 border-t border-blue-200 flex flex-col gap-3">
        <div class="flex-row flex">
            <span class="text-xl font-semibold">{{ __('Sub Total') }}</span>
            <span class="text-xl font-semibold ms-auto" x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(subTotal,)"></span>
        </div>
        <button class="btn--primary w-full items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z" />
            </svg>
            {{ __('Checkout') }}
        </button>
    </div>
</div>

<script>
    function cart() {
        return {
            cartDetails: [],
            subTotal: 0,
            fetchCart() {
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
                            this.subTotal += parseInt(detail.product.price);
                        }
                    })
                });
            }
        }
    }
</script>
