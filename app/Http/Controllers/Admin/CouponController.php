<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Cart\CouponResource;
use App\Models\Brand;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function create(Request $request){
        $admin = Auth::user()->admin ;
        if (!$admin){
            return response()->json(['message' => 'Authentication required'], 401);
        }
        $validatedData = $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'coupon' => 'required|string|unique:coupons,coupon|min:6|max:6',
            'percentage' => 'required|numeric|min:0|max:100',
            'dateE' => 'nullable|date',
        ]);
        $coupon = Coupon::create($validatedData);
        return response()->json(['message'=>'Coupon created successfully' , 'coupon'=>$coupon] , 201);

    }
    public function update(Request $request, Coupon $coupon)
    {
        $admin = Auth::user()->admin ;
        if (!$admin){
            return response()->json(['message' => 'Authentication required'], 401);
        }
        $validatedData = $request->validate([
            'percentage' => 'required|numeric|min:0|max:100',
            'dateE' => 'nullable|date',
        ]);
        $coupon->update($validatedData);
        return response()->json(['message'=>'Coupon updated successfully' , 'coupon'=>$coupon] , 200);
    }

    public function delete(Coupon $coupon)
    {
        $admin = Auth::user()->admin ;
        if (!$admin){
            return response()->json(['message' => 'Authentication required'], 401);
        }
        $coupon->delete();
        return response()->json(['message'=>'Coupon deleted successfully' ] , 200);
    }

    public function indexAll()
    {
        $admin = Auth::user()->admin ;
        if (!$admin){
            return response()->json(['message' => 'Authentication required'], 401);
        }
        $coupons = Coupon::all();
        return response()->json(['coupons'=>CouponResource::collection($coupons)] , 200);
    }



}
