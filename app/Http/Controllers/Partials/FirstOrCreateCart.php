<?php

namespace App\Http\Controllers\Partials;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Model;

trait FirstOrCreateCart
{
    public function firstOrCreateCart($sessionId): Cart|Model
    {
        $cart = Cart::query()
            ->with(['details', 'details.product', 'details.product.images'])
            ->firstOrCreate(
                ['session_id' => $sessionId,]
            );
        $cart->save();
        return $cart;
    }
}
