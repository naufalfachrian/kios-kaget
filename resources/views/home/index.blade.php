<x-app-layout>
    <div class="py-12 flex flex-col justify-center" x-data="home()" x-init="flashMessage()">
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
                    <a href="{{ route('products.show', ['product' => $product->id]) }}">
                        <div class="flex flex-col">
                            <div class="w-full aspect-square rounded-xl shadow-md shadow-brand-black/20 overflow-hidden">
                                @if (count($product->images) > 0)
                                    <img class="" src="{{$product->images[0]->image_url}}"/>
                                @endif
                            </div>
                            <span class="text-lg font-bold text-brand-light">{{ $product->name }}</span>
                            <span class="text-md font-medium text-brand-light">{{ $product->formattedPrice() }}</span>
                        </div>
                    </a>
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
