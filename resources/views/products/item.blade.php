<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="p-6 flex flex-col md:flex-row gap-4">
                    <div class="bg-white shadow-md rounded-lg md:basis-1/2 flex flex-col sm:flex-row p-4 gap-4">
                        @if (count($product->images) > 0)
                            <img class="rounded-lg" src="{{ $product->images[0]->image_url }}" alt="{{ $product->images[0]->image_name }}">
                            @if (count($product->images) > 1)
                                <div class="grid grid-cols-3 gap-2">
                                    @php $counter = 0 @endphp
                                    @foreach ($product->images as $image)
                                        @if ($counter !== 0)
                                            <img class="rounded-lg" src="{{ $image->image_url }}" alt="{{ $image->image_name }}">
                                        @endif
                                        @php $counter += 1 @endphp
                                    @endforeach
                                </div>
                            @endif
                        @endif
                    </div>
                    <div class="bg-white shadow-md rounded-lg md:basis-1/2 p-6 gap-4 flex flex-col">
                        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
                            {{ $product->name }}
                        </h2>
                        @if (count($product->tags) > 0)
                            <div class="flex flex-wrap justify-start gap-1">
                                @foreach ($product->tags as $tag)
                                    <span class="bg-green-100 text-xs p-1 rounded-md whitespace-nowrap">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        @endif
                        <p class="font-bold text-3xl text-gray-800">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <p class="font-normal text-md text-gray-600">{{ $product->description }}</p>
                        <hr class="border-gray-500"/>
                        <x-add-to-cart :product="$product" class=""></x-add-to-cart>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
