<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Buyer\AuthResource;
use App\Http\Resources\Seller\SellersResource;
use App\Mail\ValidateSeller;
use App\Mail\WelcomeEmail;
use App\Models\Adds;
use App\Models\Admin;
use App\Models\Ads;
use App\Models\Brand;
use App\Models\Buyer;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    //
    public function login(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string',
        ]);
        $is_exist = Auth::guard('buyer')->attempt($validated);
        if (!$is_exist) {
            return response()->json(['message' => 'Incorrect Email Or Password'], 401);
        }
        $buyer = auth('buyer')->user();
        $admin = Admin::where('buyer_id', $buyer->id)->first();
        if (!$admin) {
            Auth::guard('buyer')->logout();
            return response()->json(['message' => 'You are not authorized to access the admin panel'], 401);
        }
        $token = $buyer->createToken('buyer_token')->plainTextToken;
        return response()->json(['token' => $token, 'buyer' => new AuthResource($buyer)], 200);
    }

    public function updateUser(Request $request){
        $admin = Auth::user()->admin ;
        if (!$admin){
            return response()->json(['message' => 'Authentication required'], 401);
        }
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
        $admin = Auth::user()->admin ;
        if (!$admin){
            return response()->json(['message' => 'Authentication required'], 401);
        }
        if (!$seller){
            return response()->json(['message'=>'Seller not found'],404);
        }
        $seller->status = true ;
        $seller->save();
        $brand = $seller->brand ;
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
        $admin = Auth::user()->admin ;
        if (!$admin){
            return response()->json(['message' => 'Authentication required'], 401);
        }
        if (!$buyer){
            return response()->json(['message'=>'Buyer not found'],404);
        }
        $buyer->delete();
        return response()->json(['message'=>'user deleted successfully'],200);
    }
    public function rejectSeller(Seller $seller)
    {
        $admin = Auth::user()->admin ;
        if (!$admin){
            return response()->json(['message' => 'Authentication required'], 401);
        }
        if (!$seller){
            return response()->json(['message'=>'Seller not found'],404);
        }
        $buyer = $seller->buyer()->first();
        $buyer->role = false ;
        $buyer->save();
        return response()->json(['message'=>'Seller rejected successfully'],200);
    }

    public function storeAdds(Request $request)
    {
        $admin = Auth::user()->admin ;
        if (!$admin){
            return response()->json(['message' => 'Authentication required'], 401);
        }
        $validatedData = $request->validate([
            'text' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120'
        ]);
        if ($request->hasFile('image')) {
            $logoPath = $request->file('image')->store('ads', 'public');
            $validatedData['image'] = $logoPath;
        }
        $adds = Ads::create([
            'text' => request('text'),
            'image' => $validatedData['image'],
        ]);
        if (!$adds){
            return response()->json(['message' => 'Ads not found'], 404);
        }
        return response()->json(['message'=>'Ads added successfully' , 'adds' => $adds],201);


    }
    public function updateAdds(Request $request, Ads $ad)
    {
        $admin = Auth::user()->admin;
        if (!$admin) {
            return response()->json(['message' => 'Authentication required'], 401);
        }

        $validatedData = $request->validate([
            'text' => 'nullable|string',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:5120'
        ]);

        if ($request->hasFile('image')) {
            if ($ad->image) {
                Storage::disk('public')->delete($ad->image);
            }
            $logoPath = $request->file('image')->store('adds', 'public');
            $validatedData['image'] = $logoPath;
        }
        $ad->update($validatedData);
        return response()->json(['message' => 'Ad updated successfully', 'ad' => $ad], 200);
    }
    public function deleteAdds($ad)
    {
        $admin = Auth::user()->admin;
        if (!$admin) {
            return response()->json(['message' => 'Authentication required'], 401);
        }

        $ads = Ads::find($ad);
        if (!$ads) {
            return response()->json(['message' => 'Ad not found'], 404);
        }

        if ($ads->image) {
            Storage::disk('public')->delete($ads->image);
        }

        $ads->delete();

        return response()->json(['message' => 'Ad deleted successfully'], 200);
    }

    public function indexAdds()
    {
        $ads = Ads::all();
        return response()->json(['ads' => $ads], 200);
    }

}
