@props(['product'])

<div class="flex flex-col">
    <a href="{{ route('products.show', ['product' => $product->id]) }}">
        <div class="w-full aspect-square rounded-xl shadow-md shadow-brand-black/20 overflow-hidden">
            @if (count($product->images) > 0)
                <img class="" src="{{$product->images[0]->image_url}}"/>
            @endif
        </div>
    </a>
    @if (isset($product->category))
        <span class="text-sm font-normal text-brand-light">{{ $product->category->name }}</span>
    @endif
    <a href="{{ route('products.show', ['product' => $product->id]) }}">
        <span class="text-lg font-bold text-brand-light">{{ $product->name }}</span>
    </a>
    <span class="text-md font-medium text-brand-light">{{ $product->formattedPrice() }}</span>
    @if (count($product->tags) > 0)
        <div class="flex flex-wrap justify-start gap-0.5">
            @foreach ($product->tags as $tag)
                <a href="{{ route('tags.show', ['tag' => $tag]) }}">
                    <span class="bg-green-100 text-xs p-1 rounded-md whitespace-nowrap">{{ $tag->name }}</span>
                </a>
            @endforeach
        </div>
    @endif
</div>
