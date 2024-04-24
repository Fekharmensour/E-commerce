<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Profile\UpdateRequest;
use App\Models\Buyer;
use http\Env\Response;
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
}
