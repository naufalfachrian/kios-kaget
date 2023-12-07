@if(count($products) == 0)
<div class="rounded-s-full py-2 ms-2 ps-4 md:rounded-md bg-red-100 md:p-2 md:ms-0">
    <span class="text-sm">No results.</span>
</div>
@else
<div class="gap-4 grid sm:grid-cols-4 grid-cols-2">
    @foreach ($products as $product)
        <a
            @if(str_contains(Route::currentRouteName(), 'products.'))
                href="{{ route('products.edit', $product) }}"
            @else
                href="{{ route('homepage', ['product_id' => $product->id]) }}"
            @endif
        >
            <div class="bg-white shadow sm:rounded-lg relative overflow-hidden">
                @if(Auth::check() && Auth()->user()->hasPermission('PRODUCT_MASTER'))
                    <div class="absolute right-0 top-0 mt-2 me-2 gap-1.5 flex">
                        <button class="shadow-lg hover:shadow bg-red-500/60 backdrop-blur-xl hover:bg-red-600/80 p-2 rounded-lg text-white"
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-product-deletion'); confirmDeleteProduct({{json_encode($product)}}); action = '{{ route('products.destroy', ['product' => $product->id]) }}'">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </div>
                @endif
                <div
                    class="w-full aspect-square auto flex items-center justify-center">
                    @if (count($product->images) > 0)
                        <img class="" src="{{$product->images[0]->image_url}}"/>
                    @endif
                </div>
                <div class="p-2 flex flex-col">
                    <span class="font-light text-gray-800 text-sm">{{ $product->name }}</span>
                    <span class="font-semibold text-gray-800 text-md">{{ $product->formattedPrice() }}</span>
                    @if (count($product->tags) > 0)
                        <div class="flex flex-wrap justify-start gap-0.5">
                            @foreach ($product->tags as $tag)
                                <span class="bg-green-100 text-xs p-1 rounded-md whitespace-nowrap">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </a>
    @endforeach
</div>
<div class="mt-4">
    {{ $products->onEachSide(5)->links() }}
</div>
@endif
