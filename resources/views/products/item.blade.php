<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 flex flex-col md:flex-row gap-4">
                    <div class="md:basis-3/4 flex flex-col sm:flex-row gap-4">
                        <div class="flex flex-col basis-1/3 gap-2">
                            @if (count($product->images) > 0)
                                <img src="{{ $product->images[0]->image_url }}" alt="{{ $product->images[0]->image_name }}">
                                @if (count($product->images) > 1)
                                    <div class="grid grid-cols-3 gap-2">
                                        @php $counter = 0 @endphp
                                        @foreach ($product->images as $image)
                                            @if ($counter !== 0)
                                                <img src="{{ $image->image_url }}" alt="{{ $image->image_name }}">
                                            @endif
                                            @php $counter += 1 @endphp
                                        @endforeach
                                    </div>
                                @endif
                            @endif
                        </div>
                        <div class="basis-2/3 gap-2 flex flex-col">
                            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
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
                        </div>
                    </div>
                    <div class="md:basis-1/4">
                        <div class="flex flex-row md:flex-col lg:border rounded-lg p-0 lg:p-3 gap-4 md:gap-0">
                            <div class="mb-4 hidden md:block">
                                <label for="qty" class="block text-gray-700 text-sm font-bold mb-2">Jumlah Pembelian</label>
                                <input type="number" id="qty" name="qty" class="w-full border rounded-lg p-2" value="1">
                            </div>
                            <button class="btn--primary w-full bg-orange-500 items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z" />
                                </svg>
                                {{ __('Add to Card') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
