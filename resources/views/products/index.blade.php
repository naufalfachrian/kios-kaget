<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products') }}
        </h2>
        <x-primary-button-link class="ml-auto" href="{{ route('products.create') }}"
                               x-data="">
            {{ __('Add Product') }}
        </x-primary-button-link>
    </x-slot>

    <script>

    </script>
</x-app-layout>
