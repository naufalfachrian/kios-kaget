<div x-data="cart" x-init="fetchCart" class="flex flex-col p-6 gap-6"
     @cart-reload.window="fetchCart">
    <h2 class="text-xl font-semibold text-gray-800">{{ __('Cart') }}</h2>
    <div class="flex flex-col gap-4">
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
</div>

<script>
    function cart() {
        return {
            cartDetails: [],
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
                        console.log(this.cartDetails);
                    })
                });
            }
        }
    }
</script>
