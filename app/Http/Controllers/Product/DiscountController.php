<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Cart\CartsResource;
use App\Http\Resources\Product\DiscountResource;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Discount;
use App\Models\Product;
use App\Models\Reward;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscountController extends Controller
{
    public function discounts(Cart $cart)
    {
        $buyer = Auth::user();
        if (!$buyer){
            return response()->json(["message" => "Authorization failed"] , 401);
        }
        $product = $cart->product ;
        $discounts = Discount::where('seller_id' , $product->seller_id)->get() ;
        return response()->json(['discounts' => DiscountResource::collection($discounts)] , 200);
    }

    public function store(Request $request )
    {
        $seller = Auth::user()->seller;
        if (!$seller){
            return response()->json(["message" => "Authorization failed"] , 401);
        }
        $validated = $request->validate([
            'discount' => 'required|numeric|min:0|max:999.99',
            'max_discount' => 'nullable|numeric|min:0|max:999.9',
            'dateE' => 'nullable|date',
        ]);
        $discoutExist = Discount::where('seller_id' , $seller->id)->where('discount' , $validated['discount'])->first();
        if ($discoutExist){
            return response()->json(["message" => "Discount already exist"] , 401);
        }
         $validated['seller_id'] = $seller->id;
         $discount = Discount::create($validated);
         if (!$discount){
             return response()->json(["message" => "Failed to create discount"] , 401);
         }
         return response()->json([ 'message' => 'Discount created successfully ' , 'discount' => new DiscountResource($discount)] , 201);
    }

    public function active(Request $request , Discount $discount)
    {
        $buyer = Auth::user();
        if (!$buyer){
            return response()->json(["message" => "Authorization failed"] , 401);
        }
        $validated = $request->validate([
            'cart_id' => 'required|exists:carts,id',
        ]);
        $cart = Cart::find($request->get('cart_id'));
        if ($buyer->id != $cart->buyer_id){
            return response()->json(["message" => "Unauthorized"] , 401);
        }
        $seller = $cart->product->seller;
        if ($seller->id != $discount->seller_id  ){
            return response()->json(["message" => "Discount not exist"] , 401);
        }
        $reward = Reward::where('seller_id' , $seller->id)->where('buyer_id' , $buyer->id)->first();
        if(!$reward){
            return response()->json(["message" => "you can't use this discount"] , 400);
        }
        $calcDiscount = $reward->point * $discount->discount;
        if( $calcDiscount > $discount->max_discount ){
            $calcDiscount = $discount->max_discount ;
        }
        $price = $cart->product->price ;
        $new_Price = $price  -  $price * ($calcDiscount / 100);
        $cart->new_price = $new_Price ;
        $cart->discount_value = $discount->discount ;
        $cart->save();
        return response()->json(['message' => 'discount activated successfully' , 'cart' => new CartsResource($cart)] ,200 );
    }
    public function deactivate(Cart $cart){
        $buyer = Auth::user();
        if (!$buyer){
            return response()->json(["message" => "Authorization failed"] , 401);
        }
        if ($buyer->id != $cart->buyer_id){
            return response()->json(["message" => "Unauthorized"] , 401);
        }
        $cart->new_price = null ;
        $cart->discount_value = null ;
        $cart->save();
        return response()->json(['message' => 'discount deactivated successfully' , 'cart' => new CartsResource($cart)] ,200 );
    }

    public function update(Request $request , Discount  $discount)
    {
        $seller = Auth::user()->seller;
        if (!$seller){
            return response()->json(["message" => "Authorization failed"] , 401);
        }
        if($seller->id != $discount->seller_id){
            return response()->json(["message" => "Discount Not Found"] , 401);
        }
        $validated = $request->validate([
            'discount' => 'required|numeric|min:0|max:999.99',
            'max_discount' => 'nullable|numeric|min:0|max:999.9',
            'dateE' => 'nullable|date',
        ]);
        $exist = Discount::where('discount' , $validated['discount'])->where('id' , '!=' , $discount->id)->exists();
        if($exist){
            return response()->json(["message" => "Discount already exist"] , 401);
        }
        $discount->update($validated);
        return response()->json(['message' => 'Discount updated successfully' , 'discount' => new DiscountResource($discount)] , 200);

    }
    public function delete(Discount $discount){
        $seller = Auth::user()->seller;
        if (!$seller){
            return response()->json(["message" => "Authorization failed"] , 401);
        }
        if($seller->id != $discount->seller_id){
            return response()->json(["message" => "Discount Not Found"] , 401);
        }
        $discount->delete();
        return response()->json(['message' => 'Discount deleted successfully' ] , 200);
    }

    public function searchCoupon(Request $request)
    {
        $buyer = Auth::user();
        if (!$buyer){
            return response()->json(["message" => "Authorization failed"] , 401);
        }
        $validated = $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'search' => 'required|string'
        ]);
        $cart = Cart::find($request->get('cart_id'));
        if ($buyer->id != $cart->buyer_id){
            return response()->json(["message" => "Unauthorized"] , 401);
        }
        $brand = $cart->product->seller->brand;
        $coupon = Coupon::where('coupon' , $request->get('search'))->first();
        if (!$coupon || $coupon->brand_id != $brand->id){
            return response()->json(["message" => "coupon code not found"] , 400);
        }
        return response()->json(['message'=>'Coupon was Found', 'coupon' => $coupon] , 200) ;

    }

    public function activateCoupon( Request $request , Coupon $coupon)
    {
        $buyer = Auth::user();
        if (!$buyer){
            return response()->json(["message" => "Authorization failed"] , 401);
        }
        $validated = $request->validate([
            'cart_id' => 'required|exists:carts,id',
        ]);
        $cart = Cart::find($request->get('cart_id'));
        if ($buyer->id != $cart->buyer_id){
            return response()->json(["message" => "Unauthorized"] , 401);
        }
        $price = $cart->product->price ;
        $new_price = $price - $price * ($coupon->percentage / 100) ;
        $cart->new_price = $new_price ;
        $cart->discount_value = $coupon->percentage ;
        $cart->save();
        return response()->json(['message' => 'Coupon activated successfully' , 'cart' => new CartsResource($cart)] ,200);
    }



}
