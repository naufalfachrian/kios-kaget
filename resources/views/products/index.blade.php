<x-app-layout>
    <div class="py-12" x-data="deleteProductForm()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 gap-4 flex flex-col">
            <div class="basis-1/6 hidden">
                @include('products.partials.filter', ['tagGroups' => $tagGroups])
            </div>
            <div class="flex flex-col gap-2">
                @if ($hasFilters)
                    <div class="rounded-s-full py-2 ms-2 ps-4 md:rounded-md bg-yellow-100 md:p-2 md:ms-0">
                        <span class="text-sm">Results are filtered. <a href="{{ route(request()->route()->getName()) }}" class="text-blue-500">Remove filter</a>.</span>
                    </div>
                @endif
                @include('products.partials.list', ['products' => $products])
            </div>
        </div>
    </div>
</x-app-layout>
