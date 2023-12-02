<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Partials\FirstOrCreateCart;
use App\Http\Requests\StoreCartDetailRequest;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class CartDetailController extends Controller
{
    use FirstOrCreateCart;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = $this->firstOrCreateCart(request()->header('x-cart-session-id'));
        return response()->json($cart);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartDetailRequest $request)
    {
        $cart = $this->firstOrCreateCart($request->header('x-cart-session-id'));
        $product = Product::find($request->get('product_id'));
        $cartDetail = CartDetail::firstOrNew([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
        ]);
        $cartDetail->fill([
            'quantity' => $cartDetail->quantity + $request->get('quantity'),
            'product_name' => $product->name,
            'product_price' => $product->price,
            'product_description' => $product->description,
            'product_weight_in_grams' => $product->weight_in_grams,
        ]);
        $cartDetail->save();
        if ($request->expectsJson()) {
            return response()->json($cartDetail, 201);
        }
        return redirect()->back()->with(['success' => [
            'title' => 'Product added to cart!',
            'text' => 'Product ' . $product->name . ' has been added to your cart.',
            'color' => 'bg-green-500/60'
        ]]);
    }

    /**
     * Display the specified resource.
     */
    public function show(CartDetail $cartDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CartDetail $cartDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CartDetail $cartDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartDetail $cartDetail)
    {
        //
    }
}
