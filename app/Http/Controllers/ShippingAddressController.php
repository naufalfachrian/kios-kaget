<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShippingAddressRequest;
use App\Http\Requests\UpdateShippingAddressRequest;
use App\Models\ShippingAddress;
use Illuminate\Support\Facades\Auth;

class ShippingAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('shipping-address.index',[
            'shippingAddresses' => Auth::user()->shippingAddresses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('shipping-address.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShippingAddressRequest $request)
    {
        $create = new ShippingAddress();
        $create->fill($request->all());
        $create->user()->associate(Auth::user());
        $create->save();
        return redirect()->route('shipping-addresses.index')->with(['success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(ShippingAddress $shippingAddress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShippingAddress $shippingAddress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShippingAddressRequest $request, ShippingAddress $shippingAddress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShippingAddress $shippingAddress)
    {
        //
    }
}
