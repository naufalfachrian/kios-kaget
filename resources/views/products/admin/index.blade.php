@php use App\Models\Permission; @endphp
<x-admin-layout>
    <x-admin-header>
        <x-slot name="title">
            {{ __('Products') }}
        </x-slot>
        <x-slot name="right">
            @if (Auth::user()->hasPermission(Permission::$PRODUCT_MASTER))
                <x-admin-header-button click="window.location.href='{{ route('products.create') }}'">
                    <x-heroicons-sparkles></x-heroicons-sparkles>
                    {{ __('New Product') }}
                </x-admin-header-button>
            @endif
        </x-slot>
    </x-admin-header>

    <div x-data="productAdminIndex()"
         @confirm-delete-product.window="confirmDeleteProduct($event.detail)"
         @edit-product.window="editProduct($event.detail)">
        @include('products.admin.list', ['products' => $products])
        <x-modal name="confirm-product-deletion" focusable>
            <form method="post" x-ref="form" class="p-6" :action="action">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Are you sure you want to delete product named ') }}<span
                        x-text="productName"></span>{{ __('?') }}
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
        function productAdminIndex() {
            return {
                product: null,
                action: null,
                productName: null,
                confirmDeleteProduct(product) {
                    this.product = product;
                    this.productName = product.name;
                    this.action = '{{ route('products.index') }}/' + product.id;
                    this.$dispatch('open-modal', 'confirm-product-deletion');
                },
                editProduct(product) {
                    window.location.href = '{{ route('products.index') }}/' + product.id + '/edit';
                },
            }
        }
    </script>
</x-admin-layout>
