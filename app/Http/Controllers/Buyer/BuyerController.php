<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateRequest;
use App\Http\Resources\Buyer\BuyerResource;
use App\Http\Resources\Cart\CartsResource;
use App\Models\Buyer;
use App\Models\Cart;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class BuyerController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = Buyer::query();

        if ($request->has('status') ) {
            $query->whereHas('seller', function ($query) {
                $query->where('status', true);

            });
        }

        if ($request->has('role')) {
            $query->where('role', $request->role);
        }

        if ($request->has('search')) {
            $query->where('username', 'like', '%' . $request->search . '%');
        }

        // Call paginate directly on the query builder
        $users = $query->paginate(8);

        // Transform users using BuyerResource
        $formattedUsers = BuyerResource::collection($users);

        return response()->json([
            'users' => $formattedUsers,
            'paginate' => [
                'total' => $users->total(),
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
                'path' => $users->path(),
                'prev_page_url' => $users->previousPageUrl(),
                'next_page_url' => $users->nextPageUrl(),
            ],
        ]);
    }

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
        $buyer->role = true ;
        $buyer->save();
        if ($buyer->seller()->exists()) {
            return response()->json(['message' => 'Buyer is already a seller'], 400);
        }

        $seller = Seller::create([
            'buyer_id' => $buyer->id,
            'is_owner'=> false,
            'brand_id' => $request->brand_id,
            'commercialRecord' => $validateData['commercialRecord'] ,
        ]);

        return response()->json(['message' => 'Seller created successfully', 'seller' => $seller], 201);
    }






}
