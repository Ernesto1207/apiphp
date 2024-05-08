<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurantId = auth()->user()->id;

        $products = Product::where('restaurant_id', $restaurantId)->get();

        // return response()->json(['products' => $products]);

        $formattedProducts = $products->map(function ($product) {
            return [
                'restaurant_id' => $product->restaurant->name,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'category' => $product->category,
                'image' => $product->image,
                'stock' => $product->stock,
                'created_at' => $product->created_at->format('H:i / d-m-Y'),
                'updated_at' => $product->updated_at->format('H:i / d-m-Y')
            ];
        });

        return response()->json(['products' => $formattedProducts]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest  $request)
    {
        $product = Product::create($request->validated());
        return response()->json(['message' => 'Product created successfully', 'product' => $product], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json(['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return response()->json(['message' => 'Product updated successfully', 'product' => $product]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
