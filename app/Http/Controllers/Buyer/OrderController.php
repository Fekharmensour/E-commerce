<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Resources\Order\OrderResource;
use App\Http\Resources\Order\OrderSellerResource;
use App\Http\Resources\Order\OrdersResource;
use App\Models\Cart;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Seller;
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
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        if ($cart->is_ordered === 1 &&  $cart->orders()->where('accepted', false)->exists()) {
            return response()->json(['message' => 'This order is already exist'], 403);
        }
        $order = Order::create([
            'cart_id' => $cart->id
        ]);
        if (!$order){
            return response()->json(['message' => 'Something went wrong'], 500);
        }
        $cart->is_ordered = true;
        $cart->save();
        $product = $cart->product;
        $seller = $product->seller;
        Notification::create([
            'sender' => $buyer->id,
            'receiver' => $seller->buyer->id,
            'title' => 'New Order',
            'body' => 'You have received a new order for the product: ' . $product->name,
            'status' => 'success',
        ]);
        return response()->json([ 'message' => 'the order sent successfully' ,'order' => new OrderResource($order)], 201);
    }
    public function index()
    {
        $buyer = Auth::user();
        if (!$buyer) {
            return response()->json(['message' => 'Authentication required'], 401);
        }
        $orders = Order::whereHas('cart', function ($query) use ($buyer) {
            $query->where('buyer_id', $buyer->id);
        })->get();
        return response()->json(['orders' => OrdersResource::collection($orders)], 200);
    }
    public function sellerIndex()
    {
        $seller = Auth::user()->seller;
        if (!$seller) {
            return response()->json(['message' => 'Authentication required'], 401);
        }
        $orders = Order::whereHas('cart.product', function ($query) use ($seller) {
            $query->where('seller_id', $seller->id);
        })->get();
        return response()->json(['orders' => OrderSellerResource::collection($orders)], 200);
    }
    public function acceptOrder(Order $order){
        $seller = Auth::user()->seller;
        if (!$seller) {
            return response()->json(['message' => 'Authentication required'], 401);
        }
        if ($order->cart->product->seller_id !== $seller->id) {
            return response()->json(['message' => 'This product is not found'], 401);
        }
        if($order->reject === 1 || $order->accepted ===1){
            return response()->json(['message' => 'This order is already rejected or accepted'], 401);
        }

        $order->accepted = true ;
        $order->save();
        $product = $order->cart->product;
        Notification::create([
            'sender' => $seller->buyer->id,
            'receiver' => $order->cart->buyer_id,
            'title' => 'Order Accepted',
            'body' => 'Your order for ' . $product->name . ' has been accepted.',
            'type' => 'success',
        ]);
        return response()->json([ 'message' => 'the order accepted successfully' ,'order' => new OrderSellerResource($order)], 200);
    }
    public function rejectOrder(Order $order){
        $seller = Auth::user()->seller;
        if (!$seller) {
            return response()->json(['message' => 'Authentication required'], 401);
        }
        if ($order->cart->product->seller_id !== $seller->id) {
            return response()->json(['message' => 'This product is not found'], 401);
        }
        if($order->reject === 1 || $order->accepted ===1){
            return response()->json(['message' => 'This order is already rejected or accepted'], 401);
        }
        $order->reject = true ;
        $order->save();
        $product = $order->cart->product;
        Notification::create([
            'sender' => $seller->buyer->id,
            'receiver' => $order->cart->buyer_id,
            'title' => 'Order Rejected',
            'body' => 'Your order for ' . $product->name . ' has been rejected.',
            'type' => 'danger',
        ]);
        return response()->json([ 'message' => 'the order accepted successfully' ,'order' => new OrderSellerResource($order)], 200);
    }
    public function showSellerOrder(Order $order)
    {
        $seller = Auth::user()->seller;
        if (!$seller) {
            return response()->json(['message' => 'Authentication required'], 401);
        }
        $product = $order->cart->product;
        if ($product->seller_id !== $seller->id){
            return response()->json(['message' => 'This Order is not found'], 401);
        }
        return response()->json(['order' => new OrderSellerResource($order)], 200);
    }
    public function sellerAcceptedOrders(){
        $seller = Auth::user()->seller;
        if (!$seller) {
            return response()->json(['message' => 'Authentication required'], 401);
        }
        $orders = Order::whereHas('cart.product', function ($query) use ($seller) {
            $query->where('seller_id', $seller->id);
        })->where('accepted', true)->get();
        return response()->json(['orders' => OrderSellerResource::collection($orders)], 200);
    }
    public function sellerRejectedOrders(){
        $seller = Auth::user()->seller;
        if (!$seller) {
            return response()->json(['message' => 'Authentication required'], 401);
        }
        $orders = Order::whereHas('cart.product', function ($query) use ($seller) {
            $query->where('seller_id', $seller->id);
        })->where('reject', true)->get();
        return response()->json(['orders' => OrderSellerResource::collection($orders)], 200);
    }
    public function waitingOrders(){
        $seller = Auth::user()->seller;
        if (!$seller) {
            return response()->json(['message' => 'Authentication required'], 401);
        }
        $orders = Order::whereHas('cart.product', function ($query) use ($seller) {
            $query->where('seller_id', $seller->id);
        })->where('reject', false)->where('accepted', false)->get();
        return response()->json(['orders' => OrderSellerResource::collection($orders)], 200);
    }
    public function showOrder(Order $order)
    {
        $buyer = Auth::user();
        if (!$buyer) {
            return response()->json(['message' => 'Authentication required'], 401);
        }
        $cart = $order->cart;
        if ($cart->buyer_id !== $buyer->id){
            return response()->json(['message' => 'This Order is not found'], 401);
        }
        return response()->json(['order' => new OrderResource($order)], 200);
    }
    public function acceptedHisOrders(){
        $buyer = Auth::user();
        if (!$buyer) {
            return response()->json(['message' => 'Authentication required'], 401);
        }
        $orders = Order::whereHas('cart', function ($query) use ($buyer) {
            $query->where('buyer_id', $buyer->id);
        })->where('accepted', true)->get();
        return response()->json(['orders' => OrderResource::collection($orders)], 200);
    }
    public function rejectedHisOrders(){
        $buyer = Auth::user();
        if (!$buyer) {
            return response()->json(['message' => 'Authentication required'], 401);
        }
        $orders = Order::whereHas('cart', function ($query) use ($buyer) {
            $query->where('buyer_id', $buyer->id);
        })->where('reject', true)->get();
        return response()->json(['orders' => OrderResource::collection($orders)], 200);
    }
    public function waitingHisOrders(){
        $buyer = Auth::user();
        if (!$buyer) {
            return response()->json(['message' => 'Authentication required'], 401);
        }
        $orders = Order::whereHas('cart', function ($query) use ($buyer) {
            $query->where('buyer_id', $buyer->id);
        })->where('reject', false)->where('accepted', false)->get();
        return response()->json(['orders' => OrderResource::collection($orders)], 200);
    }

}
