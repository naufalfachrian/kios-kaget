<?php

namespace App\Http\Controllers\Partials;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Model;

trait FirstOrFailCart
{
    public function firstOrFailCart($sessionId): Cart|Model
    {
        $cart = Cart::query()
            ->with(['details', 'details.product', 'details.product.images']);
        return $cart->where([
            'session_id' => $sessionId,
        ])->firstOrFail();
    }
}
