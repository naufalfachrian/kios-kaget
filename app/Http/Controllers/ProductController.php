<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Tag;
use Ramsey\Uuid\Uuid;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Product::class);
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::query()->orderBy('created_at', 'DESC')->paginate(24);
        return view('products.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = new Product();
        $product->fill($request->only($product->getFillable()));
        $product->save();
        $product_images = $request->get('product_images');
        foreach ($product_images as $product_image_id) {
            $product_image = ProductImage::query()->where('id', '=', $product_image_id)->first();
            if ($product_image != null) {
                $product->images()->save($product_image);
            }
        }
        if ($request->has('tags')) {
            $tags = $request->get('tags');
            foreach ($tags as $tag_id) {
                $tag = Tag::query()->where('id', '=', $tag_id)->first();
                if ($tag != null) {
                    $product->tags()->save($tag, ['id' => Uuid::uuid4()->toString()]);
                }
            }
        }
        if ($request->expectsJson()) {
            return response()->json($product, 201);
        }
        return redirect()->route('products.index')->with(['success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.item', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.form', [
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->fill($request->only($product->getFillable()));
        $product->save();
        $product_images = $request->get('product_images');
        foreach ($product_images as $product_image_id) {
            $product_image = ProductImage::query()->where('id', '=', $product_image_id)->first();
            if ($product_image != null) {
                $product->images()->save($product_image);
            }
        }
        $product->tags()->sync([]);
        if ($request->has('tags')) {
            $tags = $request->get('tags');
            foreach ($tags as $tag_id) {
                $tag = Tag::query()->where('id', '=', $tag_id)->first();
                if ($tag != null) {
                    $product->tags()->save($tag, ['id' => Uuid::uuid4()->toString()]);
                }
            }
        }
        if ($request->expectsJson()) {
            return response()->json($product, 200);
        }
        return redirect()->route('products.index')->with(['success' => [
            'title' => 'Product updated!',
            'text' => 'Product ' . $product->name . ' has been updated.',
            'color' => 'bg-green-500/60'
        ]]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->images()->delete();
        $product->delete();
        return redirect()->route('products.index')->with(['success' => [
            'title' => 'Product deleted!',
            'text' => 'Product ' . $product->name . ' has been deleted.',
            'color' => 'bg-green-500/60'
        ]]);
    }
}
