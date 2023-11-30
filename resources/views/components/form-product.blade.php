@props([
    'name',
    'class',
    'product',
])

<form class="{{ $class }}"
      x-data="formProduct()"
      @product-image-stored.window="productImageStored($event.detail)"
      @product-image-patched.window="productImagePatched($event.detail)"
      @product-image-removed.window="productImageRemoved($event.detail)"
      @product-image-form-canceled.window="productImageFormCanceled()"
      action="{{ isset($product) ? route('products.update', ['product' => $product->id]) : route('products.store') }}"
      @if (!isset($product)) @submit.prevent="submitProduct()" @else method="post" @endif
      x-ref="productForm">
    @if (isset($product))
        @method('PATCH')
    @endif
    @csrf
    <template x-for="productImage in productImages">
        <input hidden name="product_images[]" :value="productImage.id"/>
    </template>
    <h3 class="block text-gray-700 text-sm font-bold mb-2">Product Image *</h3>
    <div class="grid md:grid-cols-4 grid-cols-2 gap-4 mb-4">
        <template x-for="productImage in productImages">
            <div
                class="aspect-square overflow-clip rounded-lg border-gray-500 border-2 border-dashed flex items-center justify-center hover:cursor-pointer"
                @click.prevent="productImageSelected(productImage)"
            >
                <img class="rounded-lg" :src="productImage.image_url"/>
            </div>
        </template>
        <div
            class="aspect-square rounded-lg border-gray-500 border-2 border-dashed flex items-center justify-center hover:cursor-pointer"
            @click.prevent="newProductImageForm()"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
        </div>
    </div>
    <div class="mb-4">
        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name *</label>
        <input type="text" id="name" name="name" class="w-full border rounded p-2"
               value="{{ isset($product) ? $product->name : old('name') }}">
    </div>
    <div class="mb-4" @click.away="$dispatch('close-dropdown', 'select-tags')" @keydown.escape="$dispatch('close-dropdown', 'select-tags')">
        <label for="tags" class="block text-gray-700 text-sm font-bold mb-2">Tag</label>
        <input type="text" id="tags" class="w-full border rounded p-2"
               @focus="$dispatch('open-dropdown', 'select-tags')"
               @input.debounce.500="$dispatch('find-tag', $el.value)"
               @input="$dispatch('clear-dropdown', 'select-tags');">
        <x-dropdown-select-tag class="relative z-50" name="select-tags" max="80"></x-dropdown-select-tag>
    </div>
    <div class="mb-4 grid lg:grid-cols-2 gap-4">
        <div>
            <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price *</label>
            <input type="text" id="price" class="w-full border rounded p-2"
                   :value="maskedPrice" x-mask:dynamic="$money($input, ',')" @keyup.window="updateUnmaskedPrice()" x-ref="masked_price">
            <input hidden type="number" id="unmasked_price" name="price" x-ref="unmasked_price" step=".01"
                   value="{{ isset($product) ? $product->price : old('price') }}">
        </div>
        <div>
            <label for="weight_in_grams" class="block text-gray-700 text-sm font-bold mb-2">Weight
                (in grams) *</label>
            <input type="text" id="weight_in_grams"
                   class="w-full border rounded p-2"
                   :value="maskedWeightInGrams" x-mask:dynamic="$money($input, ',')" @keyup.window="updateUnmaskedWeightInGrams()" x-ref="masked_weight_in_grams">
            <input hidden type="number" id="unmasked_weight_in_grams" name="weight_in_grams" x-ref="unmasked_weight_in_grams" step=".1"
                   value="{{ isset($product) ? $product->weight_in_grams : old('weight_in_grams') }}">
        </div>
    </div>
    <div class="mb-4">
        <label for="description"
               class="block text-gray-700 text-sm font-bold mb-2">Description</label>
        <textarea id="description" name="description" rows="4"
                  class="w-full border rounded p-2">{{ isset($product) ? $product->description : old('description') }}</textarea>
    </div>
    <button type="submit"
            :class="{'cursor-not-allowed': isSubmitting}"
            :disabled="isSubmitting"
            class="btn--primary">
        <svg :hidden="isSubmitting" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
        </svg>
        <svg :hidden="!isSubmitting"
             class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
             fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                    stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        {{ __('Save') }}
    </button>
</form>

<script>
    function formProduct() {
        return {
            @if (isset($product))
            productImages: {!! $product->images !!},
            @else
            productImages: [],
            @endif
            isSubmitting: false,
            maskedWeightInGrams: '{!! isset($product) ? number_format($product->weight_in_grams, 1, ',', '') : 0 !!}',
            maskedPrice: '{!! isset($product) ? number_format($product->price, 2, ',', '') : 0 !!}',
            submitProduct() {
                this.isSubmitting = true;
                fetch(this.$refs.productForm.action, {
                    method: 'POST',
                    body: new FormData(this.$refs.productForm),
                    headers: {
                        'Accept': 'application/json',
                        'x-csrf-token': '{{ csrf_token() }}'
                    }
                }).then(response => {
                    this.isSubmitting = false;
                    if (response.status === 201) {
                        while (this.productImages.length) {
                            this.productImages.pop();
                        }
                        this.resetProductImageForm();
                        this.$refs.productForm.reset();
                        response.json().then(product => {
                            this.$dispatch('push-notification', {
                                title: 'Product created!',
                                text: 'Product with name ' + product.name + ' has been created',
                                color: 'bg-green-500/60',
                            });
                        });
                    }
                });
            },
            productImageStored(productImage) {
                this.$dispatch('close');
                this.productImages.push(productImage);
            },
            productImagePatched(productImage) {
                this.$dispatch('close');
                const index = this.productImages.map(value => value.id).indexOf(productImage.id);
                this.productImages[index] = productImage;
            },
            productImageRemoved(productImageId) {
                this.$dispatch('close');
                const index = this.productImages.map(value => value.id).indexOf(productImageId);
                this.productImages.splice(index, 1);
            },
            productImageSelected(productImage) {
                this.$dispatch('product-image-set', productImage);
                this.$dispatch('open-modal', 'product-image-form');
            },
            productImageFormCanceled() {
                this.$dispatch('close');
            },
            resetProductImageForm() {
                this.$dispatch('close');
                this.$dispatch('reset-form', 'form-product-image');
            },
            newProductImageForm() {
                this.resetProductImageForm();
                this.$dispatch('open-modal', 'product-image-form');
            },
            updateUnmaskedPrice() {
                let price = this.$refs.masked_price.value.replaceAll('.', '').replaceAll(',', '.');
                if (price.slice(-1) === '.') {
                    price = price.slice(0, -1);
                }
                this.$refs.unmasked_price.value = price;
            },
            updateUnmaskedWeightInGrams() {
                let weightInGrams = this.$refs.masked_weight_in_grams.value.replaceAll('.', '').replaceAll(',', '.');
                if (weightInGrams.slice(-1) === '.') {
                    weightInGrams = weightInGrams.slice(0, -1);
                }
                this.$refs.unmasked_weight_in_grams.value = weightInGrams;
            },
        }
    }
</script>
