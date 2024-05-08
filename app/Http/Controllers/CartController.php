<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = auth()->id();
        $cartItems = Cart::where('user_id', $user_id)->with('product', 'restaurant')->get();
        return response()->json($cartItems);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request)
    {
        $user_id = auth()->id();
        $cartItem = new Cart([
            'user_id' => $user_id,
            'restaurant_id' => $request->restaurant_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);
        $cartItem->save();
        return response()->json(['message' => 'Item added to cart', 'cart_item' => $cartItem]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        $cart->update($request->validated());

        return response()->json(['message' => 'Cart item updated', 'cart_item' => $cart]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return response()->json(['message' => 'Cart item deleted']);
    }
}
