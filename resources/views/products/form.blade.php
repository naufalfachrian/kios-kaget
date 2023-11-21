<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($product) ? __('Edit Product') : __('Create New Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form class="mx-auto bg-white rounded p-6" x-data="productForm()"
                          action="{{ isset($product) ? route('products.update', ['products' => $product->id]) : route('products.store') }}"
                          method="post">
                        @if(isset($product))
                            @method('PATCH')
                        @endif
                        @csrf
                        <h3 class="block text-gray-700 text-sm font-bold mb-2">Product Image</h3>
                        <div class="grid md:grid-cols-4 grid-cols-2 gap-4 mb-4">
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
    </div>

    <script>
        function productForm() {
            return {

            }
        }
    </script>
</x-app-layout>
