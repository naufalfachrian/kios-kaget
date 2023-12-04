<div x-data="cart" x-init="fetchCart" class="flex flex-col flex-grow h-full"
     @cart-reload.window="fetchCart">
    <div class="flex flex-col gap-6">
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
                        <span class="text-xl my-auto font-semibold" x-text="cartDetail.quantity + ' pcs'"></span>
                        <span class="text-xl ms-auto my-auto font-semibold text-right"
                              x-text="'@ ' + new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(cartDetail.product.price,)"></span>
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
        <div class="p-6 mt-4 border border-orange-200 rounded-xl flex flex-col gap-3">
            <div class="flex-row flex">
                <span class="text-xl font-semibold">{{ __('Sub Total') }}</span>
                <span class="text-xl font-semibold ms-auto" x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(subTotal,)"></span>
            </div>
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
