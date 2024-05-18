<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ReviewResource;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index(Product $product)
    {
        $reviews = $product->reviews()->get();
        return response()->json(['reviews' => ReviewResource::collection($reviews)] , 200);
    }

    public function store(Request $request, Product $product){
        $buyer = Auth::user();
        if (!$buyer){
            return response()->json(["message" => "Authorization failed"] , 401);
        }
        if(!$product){
            return response()->json(["message" => "Product not found"] , 404);
        }
        $validatedData = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'content' => 'nullable|string',
        ]);
        $validatedData['buyer_id'] = $buyer->id ;
        $validatedData['product_id'] = $product->id ;
        $review = Review::create($validatedData);
        $product = $review->product ;
        $countRevies = Product::All()->count();
        $newRaiting = ( $countRevies * $product->rating_avg + $review->rating ) / ($countRevies + 1 );
        $product->rating_avg = $newRaiting;
        $product->save();
        if (!$review){
            return response()->json(["message" => "Failed to create review"] , 500);
        }
        return response()->json(['message' => 'Review created successfully ' ,'review' => new ReviewResource($review)] , 201);

    }

    public function update(Review $review , Request $request){
        $buyer = Auth::user();
        if (!$buyer){
            return response()->json(["message" => "Authorization failed"] , 401);
        }
        if(!$review || $review->buyer_id != $buyer->id){
            return response()->json(["message" => "Review not found"] , 404);
        }
        $validatedData = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'content' => 'nullable|string',
        ]);
        $review->update($validatedData);
        return response()->json(['message' => 'Review updated successfully ' ,'review' => new ReviewResource($review)] , 200);
    }
    public function destroy(Review $review){
        $buyer = Auth::user();
        if (!$buyer){
            return response()->json(["message" => "Authorization failed"] , 401);
        }
        if(!$review || $review->buyer_id != $buyer->id){
            return response()->json(["message" => "Review not found"] , 404);
        }
        $review->delete();
        return response()->json(['message' => 'Review deleted successfully '] , 200);
    }

    public function test(Product $product)
    {
        $buyer = Auth::user();
        if (!$buyer){
            return response()->json(["message" => "Authorization failed"] , 401);
        }
        $cart = Cart::where('product_id' , $product->id)->where('buyer_id' , $buyer->id);
        if (!$cart){
            return response()->json(false);
        }
        foreach ($cart->get() as $cartItem){
            $order = Order::where('cart_id' , $cartItem->id)->where('accepted' , '=' ,1)->first();
        }
        if (!$order){
            return response()->json(false);
        }
        return response()->json(true);

    }
}
