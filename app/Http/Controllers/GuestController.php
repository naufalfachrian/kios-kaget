<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Partials\ProductIndex;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class GuestController extends Controller
{
    use ProductIndex;

    function index(Request $request): View|RedirectResponse
    {
        if ($request->has('product_id')) {
            return $this->showProduct(Product::find($request->get('product_id')));
        }
        return $this->homepage();
    }

    function homepage(): View
    {
        return $this->productIndex();
    }

    function showProduct(Product $product): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('products.show', ['product' => $product]);
        }
        return view('products.item', ['product' => $product]);
    }
}
