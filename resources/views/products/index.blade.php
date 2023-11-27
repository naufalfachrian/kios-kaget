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

    <div class="py-12" x-data="deleteProductForm()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 gap-4 flex flex-col">
            @if(count($products) == 0)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <span>You don't have products</span>
                </div>
            </div>
            @else
            <div class="gap-4 grid lg:grid-cols-6 sm:grid-cols-4 grid-cols-2">
                @foreach($products as $product)
                <a href="{{ route('products.edit', $product) }}">
                    <div class="bg-white shadow sm:rounded-lg relative overflow-hidden">
                        <div
                            class="w-full aspect-square auto flex items-center justify-center">
                            @if(count($product->images) > 0)
                                <img class="" src="{{$product->images[0]->image_url}}"/>
                            @endif
                        </div>
                        <div class="p-2 flex flex-col">
                            <span class="font-light text-gray-800 text-sm">{{ $product->name }}</span>
                            <span class="font-semibold text-gray-800 text-md">{{ $product->formattedPrice() }}</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            {{ $products->onEachSide(5)->links() }}
            @endif
        </div>
    </div>

    <script>
        function deleteProductForm() {
            return {
            }
        }
    </script>
</x-app-layout>
