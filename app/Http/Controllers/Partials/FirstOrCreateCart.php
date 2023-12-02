<?php

namespace App\Http\Controllers\Partials;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

trait FirstOrCreateCart
{
    public function firstOrCreateCart($sessionId): Cart
    {
        $cart = Cart::query()
            ->with(['details', 'details.product', 'details.product.images']);
        if (Auth::check()) {
            $cart = $cart->firstOrCreate([
                'user_id' => Auth::user()->id,
            ]);
        }
        $cart = $cart->firstOrCreate([
            'session_id' => $sessionId,
        ]);
        $cart->save();
        return $cart;
    }
}
