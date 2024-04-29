<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Buyer\AuthResource;
use App\Http\Resources\Buyer\BuyerResource;
use App\Mail\WelcomeEmail;
use App\Models\Buyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class BuyerAuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();
        $buyer = Buyer::create(
            $request->except(['password','password_confirmation']) +
            ['password' => Hash::make($validatedData['password'])] +
            ['role' => false] +
            ['is_admin' => false ]
        );
        if (!$buyer) {
            return response()->json(['message' => 'Failed to create buyer'], 400);
        }
        $title = 'Welcome to the tajir.com for online shopping ';
        $body = 'Thank you for participating! ';
        Mail::to($buyer->email)->send(new WelcomeEmail($buyer , $title , $body));
        $token = $buyer->createToken('buyer_token')->plainTextToken;
        return response()->json(['token' => $token, 'buyer' => new AuthResource($buyer)], 201);
    }


    public function login(LoginRequest $request)
    {
        $validation = $request->validated();
        $is_exist = Auth::guard('buyer')->attempt($validation );
        if (!$is_exist) {
            return response()->json(['message' => 'Incorrect Email Or Password'], 401);
        }
        $buyer = auth('buyer')->user();
        $token = $buyer->createToken('buyer_token')->plainTextToken;
        return response()->json(['token' => $token, 'buyer' => new AuthResource($buyer)], 200);
    }




    public function buyer(Request $request)
    {
        return response()->json(['buyer' => new BuyerResource($request->user())], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    public function update_Password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $buyer = Auth::user();
        if(!Hash::check($request->old_password , $buyer->password)){
            return response()->json(['message'=> 'incorrect Password'] , 401) ;
        }
        $buyer->password = Hash::make($request->new_password);
        $buyer->save();

        return response()->json(['message' => 'Password changed successfully'], 200);

    }
}
