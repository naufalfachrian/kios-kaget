@if (count($products) == 0)
    <x-hero-warning text="You don't have any products"></x-hero-warning>
@else
<div class="gap-4 grid sm:grid-cols-4 grid-cols-2">
    @foreach ($products as $product)
        <x-admin-product-item :product="$product"></x-admin-product-item>
    @endforeach
</div>
<div class="pt-4 pb-4">
    {{ $products->onEachSide(5)->links() }}
</div>
@endif
