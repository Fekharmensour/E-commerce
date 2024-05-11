<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Seller\SellersResource;
use App\Mail\ValidateSeller;
use App\Mail\WelcomeEmail;
use App\Models\Brand;
use App\Models\Buyer;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    //
    public function updateUser(Request $request){
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'id'=>'required|exists:buyers,id',
            'birthday'=>'nullable|date',
        ]);
        $buyer = Buyer::find($request->id);
        $buyer->update($validatedData);
        return  response()->json(['message'=>'updated successfully'] , 200);
    }

    public function validateSeller(Seller $seller)
    {
     if (!$seller){
         return response()->json(['message'=>'Seller not found'],404);
     }
     $seller->status = true ;
     $seller->save();
     $brand = Brand::where('seller_id' , $seller->id)->first();
     if($seller->is_owner === 1){
         $brand->status = true ;
         $brand->save();
     }
     $buyer = $seller->buyer()->first();
     Mail::to($buyer->email)->send(new ValidateSeller($buyer));
     return response()->json(['message'=>'Seller validated'],200);

    }

    public function disabledSellers(){
        $sellers = Seller::where('status', false)
            ->with(['brand', 'buyer' ])
            ->whereHas('buyer', function ($query) {
                $query->where('role', true);
            })
            ->get();
        return response()->json(['sellers' => SellersResource::collection($sellers)], 200);
    }
    public function deleteUser(Buyer $buyer)
    {
        if (!$buyer){
            return response()->json(['message'=>'Buyer not found'],404);
        }
        $buyer->delete();
        return response()->json(['message'=>'user deleted successfully'],200);
    }
    public function rejectSeller(Seller $seller)
    {
        if (!$seller){
            return response()->json(['message'=>'Seller not found'],404);
        }
        $buyer = $seller->buyer()->first();
        $buyer->role = false ;
        $buyer->save();
        return response()->json(['message'=>'Seller rejected successfully'],200);
    }
}
