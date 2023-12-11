@props([
    'title',
    'products'
])

<x-product-listing-header class="mx-auto mb-6" :text="$title"></x-product-listing-header>
@include('products.partials.list', ['products' => $products])
