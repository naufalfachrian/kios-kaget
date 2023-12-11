<x-app-layout>
    <div class="py-12 flex flex-col justify-center" x-data="home()">
        <div id="tags" class="flex flex-col gap-12">
            @foreach ($tagGroups as $tagGroup)
                <div class="mx-auto flex flex-col">
                    <span class="mx-auto text-2xl text-brand-light font-bold">{{ $tagGroup->name }}</span>
                    <div class="flex flex-wrap gap-3 mt-4">
                        @foreach ($tagGroup->tags as $tag)
                            <div class="py-2 px-4 border-2 border-brand-yellow bg-brand-brown rounded-3xl">
                                <span class="text-brand-light">{{ $tag->name }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        <span class="mx-auto text-2xl text-brand-light font-bold mt-12">{{ __('Collections') }}</span>
        <div class="flex flex-row w-full justify-center">
            <div id="products" class="grid lg:grid-cols-4 grow max-w-7xl p-4 gap-x-6 gap-y-12">
                @foreach ($products as $product)
                <x-product-item :product="$product"></x-product-item>
                @endforeach
            </div>
        </div>
        <a class="mx-auto btn--primary mt-8" href="{{ route('products.index') }}">
            <span class="p-3">{{ __('View All') }}</span>
        </a>
    </div>

    <script>
        function home() {
            return {
            }
        }
    </script>
</x-app-layout>
