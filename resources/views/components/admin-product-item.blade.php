@props(['product'])

<div class="bg-white shadow sm:rounded-lg relative overflow-hidden">
    @if(Auth()->user()->hasPermission('PRODUCT_MASTER'))
        <x-admin-item-button
            edit="$dispatch('edit-product', JSON.parse('{!! json_encode($product) !!}'));"
            delete="$dispatch('confirm-delete-product', JSON.parse('{!! json_encode($product) !!}'));"
        >
        </x-admin-item-button>
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
