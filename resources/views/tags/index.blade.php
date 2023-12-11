<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 gap-4 flex flex-col">
            <div class="flex flex-col gap-2">
                <x-product-listing title="Tag: {{ $tag->name }}" :products="$products"></x-product-listing>
            </div>
        </div>
    </div>
</x-app-layout>
