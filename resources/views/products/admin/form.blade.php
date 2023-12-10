<x-admin-layout>
    <x-admin-header>
        <x-slot name="title">
            {{ isset($product) ? __('Edit Product') : __('Create New Product') }}
        </x-slot>
        <x-slot name="right">
        </x-slot>
    </x-admin-header>
    <x-form-product name="form-product" class="mx-auto bg-white rounded-xl shadow-xl p-6" :product="$product ?? null"></x-form-product>
    <x-modal name="product-image-form" focusable>
        <x-form-product-image name="form-product-image" class="p-6"></x-form-product-image>
    </x-modal>
</x-admin-layout>
