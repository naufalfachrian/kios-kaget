<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartDetailRequest;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $user_id = Auth::user() != null ? Auth::user()->id : null;
        $cart = Cart::firstOrNew([
            'user_id' => $user_id,
        ]);
        $cart->session_id = $request->session()->getId();
        $cart->save();
        $product = Product::find($request->get('product_id'));
        $cartDetail = CartDetail::firstOrCreate([
            'product_id' => $product->id,
        ]);
        $cartDetail->fill([
            'quantity' => $cartDetail->quantity + $request->get('quantity'),
            'product_name' => $product->name,
            'product_price' => $product->price,
            'product_description' => $product->description,
            'product_weight_in_grams' => $product->weight_in_grams,
        ]);
        $cartDetail->cart()->associate($cart);
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
