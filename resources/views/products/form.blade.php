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
                    <x-form-product name="form-product" class="mx-auto bg-white rounded p-6" :product="$product ?? null"></x-form-product>
                </div>
            </div>
        </div>
        <x-modal name="product-image-form" focusable>
            <x-form-product-image name="form-product-image" class="p-6"></x-form-product-image>
        </x-modal>
    </div>
</x-app-layout>
