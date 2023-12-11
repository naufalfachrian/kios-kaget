<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Partials\FirstOrFailCart;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    use FirstOrFailCart;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            return view('orders.admin.index', [
                'orders' => Order::query()->orderBy('created_at', 'DESC')->paginate(6),
            ]);
        }
        return view('orders.checkout');
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
    public function store(StoreOrderRequest $request)
    {
        $shippingAddress = new ShippingAddress();
        $shippingAddress
            ->fill($request->all($shippingAddress->getFillable()))
            ->fill(['label' => $request->get('email')])
            ->save();
        $order = new Order();
        $order
            ->fill($request->all($order->getFillable()))
            ->fill(['total_price' => 0])
            ->shippingAddress()->associate($shippingAddress)
            ->save();
        $cart = $this->firstOrFailCart($request->get('session_id'));
        foreach ($cart->details as $detail)
        {
            $orderDetail = new OrderDetail();
            $orderDetail->fill($detail->toArray())
                ->order()->associate($order)
                ->save();
            $order->total_price += ($detail->product->price * $detail->quantity);
            $order->save();
        }
        $cart->details()->delete();
        $cart->delete();
        return redirect()->route('homepage')->with(['success' => [
            'title' => 'Order created!',
            'text' => 'Your order has been created with ID: ' . $order->id . '.',
            'color' => 'bg-green-500/60'
        ]]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
