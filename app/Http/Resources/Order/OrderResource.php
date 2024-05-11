<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\Buyer\BuyerResource;
use App\Http\Resources\Seller\SellersResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $cart = $this->cart ;
        $product = $cart->product ;
        $image = $product ? $product->photos()->first() : null;
        $seller = $product->seller ;
        $buyer = $seller ? $seller->buyer : null;
        return [
            'id' => $this->id,
            'qte' => $cart->qte,
            'accepted' => $this->accepted ,
            'image' => $image ? $image->photo : null,
            'name' => $product ? $product->name : null,
            'price' => $product ? $product->price : null,
            'new_price'=> $cart->new_price ,
            'discount' => $cart->discount_value ,
            'total_price' => $cart->new_price? $cart->new_price * $cart->qte : $product->price * $cart->qte ,
            'seller' => [
                'id' => $seller ? $seller->id : null,
                'username'=> $buyer ? $buyer->username : null,
                'email'=> $buyer ? $buyer->email : null,
                'phone'=> $buyer ? $buyer->phone : null,
                'address'=> $buyer ? $buyer->address : null,
                'image' => $buyer ? $buyer->image : null,
            ]
        ];
    }
}
