<?php

namespace App\Http\Controllers\Partials;

use App\Models\Product;
use App\Models\TagGroup;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

trait ProductIndex
{
    function productIndex(): View|RedirectResponse
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
        if (count($products) == 0 && request()->get('page', 1) > 1) {
            return redirect()->route('products.index');
        }
        if (Auth::check()) {
            return view('products.admin.index', [
                'hasFilters' => $hasFilters,
                'products' => $products,
                'tagGroups' => $tagGroups,
            ]);
        }
        return view('products.index', [
            'hasFilters' => $hasFilters,
            'products' => $products,
            'tagGroups' => $tagGroups,
        ]);
    }
}
