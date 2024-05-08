<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\StockResource;
use App\Http\Resources\Seller\SellersResource;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{

  public function index(){
      $sellers = Seller::with(['brand', 'buyer'])->get();
      return response()->json([ 'sellers' => SellersResource::collection($sellers)], 200);
  }
  public function showSeller(Seller $seller)
  {
    return response()->json([ 'seller' => new SellersResource($seller)], 200);
  }
  public function stock()
  {
      $seller = Auth::user()->seller;
      if (!$seller) {
          return response()->json(['message' => 'Authentication required'], 401);
      }
      $stocks = Product::where('seller_id' , $seller->id)->get() ;
      return response()->json([ 'stocks' => StockResource::collection($stocks)], 200);
  }

  public function showStock(Product $product)
  {
      $seller = Auth::user()->seller;
      if (!$seller) {
          return response()->json(['message' => 'Authentication required'], 401);
      }
      if ($product->seller_id != $seller->id) {
          return response()->json(['message' => 'Product does not belong to seller'], 401);
      }
      return response()->json([ 'stock' => new StockResource($product)], 200);
  }



}
