@if(count($products) == 0)
<div class="rounded-s-full py-2 ms-2 ps-4 md:rounded-md bg-red-100 md:p-2 md:ms-0">
    <span class="text-sm">No results.</span>
</div>
@else
<div class="gap-4 grid sm:grid-cols-4 grid-cols-2">
    @foreach ($products as $product)
    <x-product-item :product="$product"></x-product-item>
    @endforeach
</div>
<div class="mt-4">
    {{ $products->onEachSide(5)->links() }}
</div>
@endif
