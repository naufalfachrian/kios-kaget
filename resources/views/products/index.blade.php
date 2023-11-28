<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products') }}
        </h2>
        <a class="btn--primary ml-auto" href="{{ route('products.create') }}"
                               x-data="">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z" />
            </svg>
            {{ __('New Product') }}
        </a>
    </x-slot>

    <div class="py-12" x-data="deleteProductForm()" x-init="flashMessage()">
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
                        <div class="absolute right-0 top-0 mt-2 me-2 gap-1.5 flex">
                            <button class="shadow-lg hover:shadow bg-red-500/60 backdrop-blur-xl hover:bg-red-600/80 p-2 rounded-lg text-white"
                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-product-deletion'); confirmDeleteProduct({{json_encode($product)}}); action = '{{ route('products.destroy', ['product' => $product->id]) }}'">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </button>
                        </div>
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
        <x-modal name="confirm-product-deletion" focusable>
            <form method="post" x-ref="form" class="p-6" :action="action">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Are you sure you want to delete product named ') }}<span x-text="productName"></span>{{ __('?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Once your product is deleted, it will be permanently deleted.') }}
                </p>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button class="ms-3">
                        {{ __('Delete') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    </div>

    <script>
        function deleteProductForm() {
            return {
                product: null,
                action: null,
                productName: null,
                confirmDeleteProduct(product) {
                    this.product = product;
                    this.productName = product.name;
                    console.log(product);
                    console.log(this.productName);
                },
                flashNotification: {!! json_encode(session()->get('success')) ?? 'null' !!},
                flashMessage() {
                    setTimeout(() => {
                        if (this.flashNotification === null) return;
                        this.$dispatch('push-notification', this.flashNotification);
                    }, 100)
                }
            }
        }
    </script>
</x-app-layout>
