<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Resources\Cart\CartsResource;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $buyer = Auth::user();
        if (!$buyer) {
            return response()->json(['message' => 'Authentication required'], 401);
        }
        $existingCart = Cart::where('product_id', $request->product_id)
            ->where('buyer_id', $buyer->id)
            ->first();
        if($existingCart && $existingCart->is_validate == 0) {
            return response()->json(['message' => 'Product already exists in the cart'], 409);
        }
        $seller = Product::find(request('product_id'))->seller;
        if($seller->buyer_id === $buyer->id) {
            return response()->json(['message' => 'You are not authorized to add this product to the cart'], 403);
        }
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);
        $cart = Cart::create([
            'product_id' => $request['product_id'],
            'buyer_id'=>$buyer->id ,
            'qte' => 1 ,
            'is_ordered'=>false
        ]);
        if (!$cart){
            return response()->json(['message' => 'Cart not added'], 401);
        }
        return response()->json(['message' => 'Product added to cart successfully' , 'cart' => new CartsResource($cart)], 201);

    }
    public function updateCart(Request $request)
    {
        $buyer = Auth::user();
        if (!$buyer) {
            return response()->json(['message' => 'Authentication required'], 401);
        }
        $request->validate([
            'id' => 'required|exists:carts,id',
            'qte' => 'required|numeric|min:1',
        ]);
        $cart = Cart::find($request->id);
        if (!$cart) {
            return response()->json(['message' => 'Cart item not found.'], 404);
        }
        if ($cart->buyer_id !== $buyer->id){
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $cart->qte = $request->qte;
        $cart->save();
        return response()->json(['message' => 'cart(Qte) updated successfully' , 'cart' => new CartsResource($cart)], 200);
    }
    public function deleteCart(Cart $cart)
    {
        $buyer = Auth::user();
        if (!$buyer) {
            return response()->json(['message' => 'Authentication required'], 401);
        }
        if ($cart->buyer_id !== $buyer->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $cart->delete();
        return response()->json(['message' => 'Cart deleted successfully'], 200);
    }
    public function clearCart()
    {
        $buyer = Auth::user();
        if (!$buyer) {
            return response()->json(['message' => 'Authentication required'], 401);
        }

        $carts = Cart::where('buyer_id', $buyer->id)->get();
        foreach ($carts as $cart) {
            $cart->delete();
        }

        return response()->json(['message' => 'Carts deleted successfully'], 200);
    }


    public function getCarts()
    {
        $buyer = Auth::user();
        if (!$buyer) {
            return response()->json(['message' => 'Authentication required'], 401);
        }
        $carts = Cart::where('buyer_id' , $buyer->id)->get() ;
        return response()->json(['Carts' => CartsResource::collection($carts)], 200);
    }
}
