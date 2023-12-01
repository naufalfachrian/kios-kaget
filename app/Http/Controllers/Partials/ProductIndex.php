<?php

namespace App\Http\Controllers\Partials;

use App\Models\Product;
use App\Models\TagGroup;
use Illuminate\Contracts\View\View;

trait ProductIndex
{
    function productIndex(): View
    {
        $products = Product::query();
        $hasFilters = false;
        if (request()->has('tag_id')) {
            $hasFilters = true;
            $products = $products->whereHas('tags', function ($q) {
                $q->where('tag_id', request()->get('tag_id'));
            });
        }
        $products = $products
            ->orderBy('created_at', 'DESC')
            ->paginate(20);
        $tagGroups = TagGroup::all();
        return view('products.index', [
            'hasFilters' => $hasFilters,
            'products' => $products,
            'tagGroups' => $tagGroups,
        ]);
    }
}
