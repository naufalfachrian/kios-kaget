<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($product) ? __('Edit Product') : __('Create New Product') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="productForm()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form class="mx-auto bg-white rounded p-6"
                          action="{{ isset($product) ? route('products.update', ['products' => $product->id]) : route('products.store') }}"
                          method="post">
                        @if(isset($product))
                            @method('PATCH')
                        @endif
                        @csrf
                        <h3 class="block text-gray-700 text-sm font-bold mb-2">Product Image</h3>
                        <div class="grid md:grid-cols-4 grid-cols-2 gap-4 mb-4">
                            <div class="bg-blue-50 aspect-square rounded-lg border-gray-300 border-2 flex items-center justify-center hover:cursor-pointer"
                                 x-on:click.prevent="$dispatch('open-modal', 'product-image-form');"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </div>
                            <div class="bg-blue-50 aspect-square rounded-lg border-gray-300 border-2 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </div>
                            <div class="bg-blue-50 aspect-square rounded-lg border-gray-300 border-2 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </div>
                            <div class="bg-blue-50 aspect-square rounded-lg border-gray-300 border-2 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name *</label>
                            <input type="text" id="name" name="name" class="w-full border rounded p-2" value="{{ isset($product) ? $product->name : old('name') }}">
                        </div>
                        <div class="mb-4 grid lg:grid-cols-2 gap-4">
                            <div>
                                <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price *</label>
                                <input type="number" id="price" name="price" class="w-full border rounded p-2" value="{{ isset($product) ? $product->price : old('price') }}">
                            </div>
                            <div>
                                <label for="weight_in_grams" class="block text-gray-700 text-sm font-bold mb-2">Weight (in grams) *</label>
                                <input type="number" id="weight_in_grams" name="weight_in_grams" class="w-full border rounded p-2" value="{{ isset($product) ? $product->weight_in_grams : old('weight_in_grams') }}">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                            <textarea id="description" name="description" rows="4" class="w-full border rounded p-2">{{ isset($product) ? $product->description : old('description') }}</textarea>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
                    </form>
                </div>
            </div>
        </div>
        <x-modal name="product-image-form" focusable>
            <form method="post" x-ref="form" class="p-6" x-on:submit.prevent="submitProductImage()">
                @csrf

                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                    {{ __('Upload Product Images') }}
                </h2>

                <div class="lg:grid lg:grid-cols-2 flex flex-col gap-3">

                    <img class="w-full aspect-square border rounded-lg auto" :src="inputProductImageSource" />

                    <div class="flex flex-col grow">
                        <div class="mb-4">
                            <label for="image_name" class="block text-gray-700 text-sm font-bold mb-2">Image Label *</label>
                            <input type="text" id="image_name" name="image_name" class="w-full border rounded p-2" x-model="productImageName">
                        </div>

                        <div class="mb-4">
                            <label for="image_file" class="block text-gray-700 text-sm font-bold mb-2">Upload Image *</label>
                            <input type="file" accept="image/jpeg" id="image_file" name="image_file" x-ref="image_file" class="w-full border rounded p-2" x-on:change="reloadPreviewProductImage()">
                        </div>
                    </div>

                </div>

                <div class="mt-6 flex gap-3">
                    <x-primary-button class='{cursor-not-allowed: !isUploadingProductImage}'>
                        <svg :class="{hidden: !isUploadingProductImage}" class="animate-spin -ml-1 mr-3 h-3 w-3 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        {{ __('Save') }}
                    </x-primary-button>

                    <x-secondary-button class="ms-auto" x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button>
                        {{ __('Delete') }}
                    </x-danger-button>
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
                reloadPreviewProductImage() {
                    let file = this.$refs.image_file.files[0];
                    if(!file || file.type.indexOf('image/') === -1) return;
                    this.inputProductImageSource = null;
                    let reader = new FileReader();
                    reader.onload = e => {
                        this.inputProductImageSource = e.target.result;
                    }
                    reader.readAsDataURL(file);
                },
                submitProductImage() {
                    this.isUploadingProductImage = true;
                    console.log("Submit product image");
                    let file = this.$refs.image_file.files[0];
                    if(!file || file.type.indexOf('image/') === -1) {
                        this.isUploadingProductImage = false;
                        return
                    }
                    const formData = new FormData();
                    formData.append('image', file);
                    formData.append('image_name', this.productImageName);
                    fetch('{{ route('product-images.store') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'x-csrf-token': '{{ csrf_token() }}'
                        }
                    }).then( response => {
                        this.isUploadingProductImage = false;
                        console.log(response);
                    });
                }
            }
        }
    </script>
</x-app-layout>
