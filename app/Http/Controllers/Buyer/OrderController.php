<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Resources\Order\OrderResource;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $buyer = Auth::user();
        if (!$buyer) {
            return response()->json(['message' => 'Authentication required'], 401);
        }
        $validated = $request->validate([
            'cart_id' => 'required|exists:carts,id',
        ]);
        $cart = Cart::find($request->cart_id);
        if ($cart->buyer_id !== $buyer->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $order = Order::create([
            'cart_id' => $cart->id
        ]);
        if (!$order){
            return response()->json(['message' => 'Something went wrong'], 500);
        }
        $cart->is_ordered = true;
        $cart->save();
        return response()->json([ 'message' => 'the order sent successfully' ,'order' => new OrderResource($order)], 201);
    }
}
