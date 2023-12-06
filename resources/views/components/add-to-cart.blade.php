@props([
    'product',
    'class'
])

<form x-data="addToCartForm" @submit.prevent="addToCart($el)" action="{{ route('cart-details.store') }}" class="{{ $class }}">
    <input hidden="" type="number" id="quantity_inc" name="quantity_inc" class="w-full border rounded-lg p-2" value="1">
    <input hidden="" type="text" id="product_id" name="product_id" value="{{ $product->id }}">
    <button type="submit" class="btn--primary w-full bg-orange-500 items-center justify-center h-14"
            :class="{'cursor-not-allowed': isSubmitting}"
            :disabled="isSubmitting">
        <svg :hidden="isSubmitting" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
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
        <span class="text-lg">{{ __('Add to Cart') }}</span>
    </button>
</form>

<script>
    function addToCartForm() {
        return {
            isSubmitting: false,
            isLastAttemptSuccess: false,
            addToCart(form) {
                this.isSubmitting = true;
                fetch(form.action, {
                    method: 'POST',
                    body: new FormData(form),
                    headers: {
                        'Accept': 'application/json',
                        'x-csrf-token': '{{ csrf_token() }}',
                        'x-cart-session-id': getSessionId(),
                    }
                }).then(response => {
                    this.isSubmitting = false;
                    this.isLastAttemptSuccess = response.status === 201
                    response.json().then(jsonResponse => {
                        if (this.isLastAttemptSuccess) {
                            this.$dispatch('push-notification', {
                                title: 'Product added to cart!',
                                text: 'Product ' + jsonResponse.product_name + ' has been added to your cart.',
                                color: 'bg-green-500/60',
                            });
                            this.$dispatch('cart-reload');
                            this.$dispatch('open-modal', 'cart');
                        } else {
                            this.$dispatch('push-notification', {
                                title: 'Failed!',
                                text: jsonResponse.message,
                                color: 'bg-red-500/60',
                            });
                        }
                    })
                })
            }
        }
    }
</script>
