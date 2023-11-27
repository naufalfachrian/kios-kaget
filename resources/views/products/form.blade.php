<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($product) ? __('Edit Product') : __('Create New Product') }}
        </h2>
    </x-slot>

    <x-slot name="notifications">
        <template x-for="notification in notifications">
            <div class="rounded-lg p-4 shadow-xl backdrop-blur-xl transform transition-all" :class="notification.color"
                 x-data="{show: false}"
                 x-show="show"
                 x-init="$nextTick(() => { show = true });setTimeout(() => show = false, 5000);"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            >
                <span class="font-semibold text-sm text-white" x-text="notification.title"></span><br/>
                <span class="text-sm text-white" x-text="notification.text"></span><br/>
            </div>
        </template>
    </x-slot>

    <div class="py-12" x-data="productForm()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form class="mx-auto bg-white rounded p-6"
                          action="{{ isset($product) ? route('products.update', ['product' => $product->id]) : route('products.store') }}"
                          @if (!isset($product)) x-on:submit.prevent="submitProduct()" @else method="post" @endif
                          x-ref="productForm">
                        @if(isset($product))
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
                                    x-on:click.prevent="selectProductImage(productImage)"
                                >
                                    <img class="rounded-lg" :src="productImage.image_url"/>
                                </div>
                            </template>
                            <div
                                class="aspect-square rounded-lg border-gray-500 border-2 border-dashed flex items-center justify-center hover:cursor-pointer"
                                x-on:click.prevent="newProductImageForm()"
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
                        <div class="mb-4 grid lg:grid-cols-2 gap-4">
                            <div>
                                <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price *</label>
                                <input type="number" id="price" name="price" class="w-full border rounded p-2"
                                       value="{{ isset($product) ? $product->price : old('price') }}">
                            </div>
                            <div>
                                <label for="weight_in_grams" class="block text-gray-700 text-sm font-bold mb-2">Weight
                                    (in grams) *</label>
                                <input type="number" id="weight_in_grams" name="weight_in_grams"
                                       class="w-full border rounded p-2"
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
                                :class="{'cursor-not-allowed': isSubmittingProduct}"
                                :disabled="isSubmittingProduct"
                                class="flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-25">
                            <svg :hidden="!isSubmittingProduct"
                                 class="animate-spin -ml-1 mr-3 h-3 w-3 text-white" xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            {{ __('Save') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <x-modal name="product-image-form" focusable>
            <form method="post" x-ref="productImageForm" class="p-6" x-on:submit.prevent="submitProductImage()">
                @csrf

                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                    {{ __('Product Image') }}
                </h2>

                <div class="lg:grid lg:grid-cols-2 flex flex-col gap-3">

                    <div
                        class="w-full overflow-clip aspect-square border border-dashed border-gray-500 rounded-lg auto bg-clip-padding flex items-center justify-center">
                        <img class="rounded-lg" :src="inputProductImageSource"/>
                    </div>

                    <div class="flex flex-col grow">
                        <div class="mb-4">
                            <label for="image_name" class="block text-gray-700 text-sm font-bold mb-2">Image
                                Label</label>
                            <input type="text" id="image_name" name="image_name" class="w-full border rounded p-2"
                                   x-model="productImageName">
                        </div>

                        <div class="mb-4">
                            <label for="image_file" class="block text-gray-700 text-sm font-bold mb-2">Upload Image
                                *</label>
                            <input type="file" accept="image/jpeg" id="image_file" name="image_file" x-ref="image_file"
                                   class="w-full border rounded p-2" x-on:change="reloadPreviewProductImage()">
                        </div>
                    </div>

                </div>

                <div class="mt-6 flex gap-3">
                    <button :class="{'cursor-not-allowed': isUploadingProductImage || inputProductImageSource === null}"
                            :disabled="isUploadingProductImage || inputProductImageSource === null"
                            class="flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-25">
                        <svg :hidden="!isUploadingProductImage"
                             class="animate-spin -ml-1 mr-3 h-3 w-3 text-white" xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <template x-if="selectedProductImage === null">
                            <span>{{ __('Save') }}</span>
                        </template>
                        <template x-if="selectedProductImage !== null">
                            <span>{{ __('Update') }}</span>
                        </template>
                    </button>

                    <x-secondary-button class="ms-auto" x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <template x-if="selectedProductImage !== null">
                        <button type="button" class="flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                                x-on:click="deleteProductImage()">
                            <svg :hidden="!isDeletingProductImage"
                                 class="animate-spin -ml-1 mr-3 h-3 w-3 text-white" xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            {{ __('Delete') }}
                        </button>
                    </template>
                </div>
            </form>
        </x-modal>
    </div>

    <script>
        function productForm() {
            return {
                inputProductImageSource: null,
                productImageName: null,
                isUploadingProductImage: false,
                isDeletingProductImage: false,
                @if (isset($product))
                productImages: {!! $product->images !!},
                @else
                productImages: [],
                @endif
                selectedProductImage: null,
                isSubmittingProduct: false,
                submitProduct() {
                    this.isSubmittingProduct = true;
                    fetch(this.$refs.productForm.action, {
                        method: 'POST',
                        body: new FormData(this.$refs.productForm),
                        headers: {
                            'Accept': 'application/json',
                            'x-csrf-token': '{{ csrf_token() }}'
                        }
                    }).then(response => {
                        this.isSubmittingProduct = false;
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
                reloadPreviewProductImage() {
                    let file = this.$refs.image_file.files[0];
                    if (!file || file.type.indexOf('image/') === -1) return;
                    this.inputProductImageSource = null;
                    let reader = new FileReader();
                    reader.onload = e => {
                        this.inputProductImageSource = e.target.result;
                    }
                    reader.readAsDataURL(file);
                },
                submitProductImage() {
                    if (this.selectedProductImage === null) {
                        this.postProductImage();
                    } else {
                        this.patchProductImage();
                    }
                },
                postProductImage() {
                    this.isUploadingProductImage = true;
                    let file = this.$refs.image_file.files[0];
                    if (!file || file.type.indexOf('image/') === -1) {
                        this.isUploadingProductImage = false;
                        return
                    }
                    const formData = new FormData();
                    formData.append('image', file);
                    if (this.productImageName != null) {
                        formData.append('image_name', this.productImageName);
                    }
                    fetch('{{ route('product-images.store') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'Accept': 'application/json',
                            'x-csrf-token': '{{ csrf_token() }}'
                        }
                    }).then(response => response.json()).then(response => {
                        this.resetProductImageForm();
                        this.productImages.push(response);
                    });
                },
                patchProductImage() {
                    this.isUploadingProductImage = true;
                    const formData = new FormData();
                    let file = this.$refs.image_file.files[0];
                    if (file && file.type.indexOf('image/') !== -1) {
                        formData.append('image', file);
                    }
                    if (this.productImageName != null) {
                        formData.append('image_name', this.productImageName);
                    }
                    fetch('{{ route('product-images.store') }}/' + this.selectedProductImage.id + '?_method=PATCH', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'Accept': 'application/json',
                            'x-csrf-token': '{{ csrf_token() }}',
                        }
                    }).then(response => response.json()).then(response => {
                        this.resetProductImageForm();
                        this.selectedProductImage = response;
                        const index = this.productImages.map(value => value.id).indexOf(response.id);
                        this.productImages[index] = response;
                    });
                },
                deleteProductImage() {
                    this.isDeletingProductImage = true;
                    const productImageId = this.selectedProductImage.id;
                    fetch('{{ route('product-images.store') }}/' + productImageId + '?_method=DELETE', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'x-csrf-token': '{{ csrf_token() }}',
                        }
                    }).then(response => response.text()).then(response => {
                        console.log(response)
                        this.resetProductImageForm();
                        const index = this.productImages.map(value => value.id).indexOf(productImageId);
                        this.productImages.splice(index, 1);
                    });
                },
                selectProductImage(productImage) {
                    this.selectedProductImage = productImage;
                    this.inputProductImageSource = productImage.image_url;
                    this.productImageName = productImage.image_name;
                    this.$dispatch('open-modal', 'product-image-form');
                },
                resetProductImageForm() {
                    this.$dispatch('close');
                    if (this.$refs.productImageForm !== undefined) {
                        this.$refs.productImageForm.reset();
                    }
                    this.inputProductImageSource = null;
                    this.productImageName = null;
                    this.isUploadingProductImage = false;
                    this.isDeletingProductImage = false;
                    this.selectedProductImage = null;
                },
                newProductImageForm() {
                    this.resetProductImageForm();
                    this.$dispatch('open-modal', 'product-image-form');
                }
            }
        }
    </script>
</x-app-layout>
