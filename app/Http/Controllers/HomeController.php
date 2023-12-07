<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\TagGroup;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    function index(Request $request): View
    {
        $tagGroups = TagGroup::query()
            ->take(env('APP_SHOW_TAG_GROUP_COUNT_ON_HOMEPAGE', 2))
            ->get();
        $products = Product::query()
            ->take(env('APP_SHOW_PRODUCT_COUNT_ON_HOMEPAGE', 12))
            ->get();
        return view('home.index', [
            'tagGroups' => $tagGroups,
            'products' => $products,
        ]);
    }
}
