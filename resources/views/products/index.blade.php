<x-app-layout>
    @if(Auth::check() && Auth()->user()->hasPermission('PRODUCT_MASTER'))
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
    @endif

    <div class="py-12" x-data="deleteProductForm()" x-init="flashMessage()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 gap-4 flex flex-col">
            <div class="basis-1/6 hidden">
                @include('products.partials.filter', ['tagGroups' => $tagGroups])
            </div>
            <div class="flex flex-col gap-2">
                @if ($hasFilters)
                    <div class="rounded-s-full py-2 ms-2 ps-4 md:rounded-md bg-yellow-100 md:p-2 md:ms-0">
                        <span class="text-sm">Results are filtered. <a href="{{ route(request()->route()->getName()) }}" class="text-blue-500">Remove filter</a>.</span>
                    </div>
                @endif
                @include('products.partials.list', ['products' => $products])
            </div>
        </div>
        @if(Auth::check() && Auth()->user()->hasPermission('PRODUCT_MASTER'))
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
        @endif
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
