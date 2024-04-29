<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateRequest;
use App\Http\Resources\Cart\CartsResource;
use App\Models\Cart;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class BuyerController extends Controller
{
    //
    public function updateProfile(UpdateRequest $request)
    {
        $buyer = Auth::user();
        if (!$buyer) {
            return response()->json(['message' => 'Authentication required'], 401);
        }
        $validation = $request->validated();
        if ($request->hasFile('image')) {
            $validation['image'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' ;
            if ($buyer->image) {
                Storage::disk('public')->delete($buyer->image);
            }
            $path = $request->file('image')->store('profile', 'public');
            $validation['image'] = $path;
        }
        $buyer->update($validation);
        return response()->json(['message' => 'Profile updated successfully', 'buyer' => $buyer], 200);
    }
    public function updateImage(Request $request )
    {
        $request->validate([
            'image' => ['required', File::image()->max(4 * 1024)]
        ]);
        $buyer = Auth::user();
        if ($request->hasFile('image')) {

            if ($buyer->image) {
                Storage::disk('public')->delete($buyer->image);
            }
            $path = $request->file('image')->store('profile', 'public');
            $buyer->image = $path;
            $buyer->save();
            return response()->json(['message' => 'Image updated successfully', 'buyer' => $buyer], 200);
        }
        return response()->json(['message' => 'Image upload failed'], 400);
    }

    public function updateRole(Request $request)
    {
        $validateData = $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'commercialRecord' => 'required|file|mimes:pdf|max:2048',
        ]);
        if ($request->hasFile('commercialRecord')) {
            $path = $request->file('commercialRecord')->store('commercialRecord', 'public');
            $validateData['commercialRecord'] = $path;
        }

        $buyer = Auth::user();
        if ($buyer->sellers()->exists()) {
            return response()->json(['message' => 'Buyer is already a seller'], 400);
        }

        $seller = Seller::create([
            'buyer_id' => $buyer->id,
            'is_owner'=>    true ,
            'brand_id' => $request->brand_id,
            'commercialRecord' => $validateData['commercialRecord'] ,
        ]);

        return response()->json(['message' => 'Seller created successfully', 'seller' => $seller], 201);
    }






}
