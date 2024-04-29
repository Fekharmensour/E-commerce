<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Resources\Seller\SellersResource;
use App\Models\Seller;

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
  public function disabledSellers(){
      $sellers = Seller::where('status' , false)->with(['brand', 'buyer'])->get();
      return response()->json([ 'sellers' => SellersResource::collection($sellers)], 200);
  }
}
