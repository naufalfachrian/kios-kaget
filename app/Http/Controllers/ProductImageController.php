<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductImageRequest;
use App\Http\Requests\UpdateProductImageRequest;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(ProductImage::class);
        $this->middleware('auth');
    }

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
    public function store(StoreProductImageRequest $request)
    {
        $imagePath = $request->file('image')->store('product_images', 'public');

        $productImage = ProductImage::create([
            'product_id' => $request->input('product_id'),
            'image_name' => $request->get('image_name') ?? $request->file('image')->getClientOriginalName(),
            'image_url' => Storage::url($imagePath),
        ]);

        return response()->json($productImage, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductImage $productImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductImage $productImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductImageRequest $request, ProductImage $productImage)
    {
        if ($request->hasFile('image')) {
            // Delete old image
            Storage::disk('public')->delete(str_replace('/storage', '', $productImage->image_url));

            // Upload new image
            $imagePath = $request->file('image')->store('product_images', 'public');

            $productImage->update([
                'product_id' => $request->input('product_id'),
                'image_name' => $request->get('image_name') ?? $request->file('image')->getClientOriginalName(),
                'image_url' => Storage::url($imagePath),
            ]);
        } else {
            $productImage->update([
                'product_id' => $request->input('product_id'),
            ]);
        }

        return response()->json($productImage, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductImage $productImage)
    {
        // Delete image file
        Storage::disk('public')->delete(str_replace('/storage', '', $productImage->image_url));

        // Delete database record
        $productImage->delete();

        return response()->json(null, 204);
    }
}
