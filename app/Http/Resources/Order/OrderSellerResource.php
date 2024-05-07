<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderSellerResource extends JsonResource
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
        $buyer = $cart->buyer;
        return [
            'id' => $this->id,
            'qte' => $cart->qte,
            'accepted' => $this->accepted ,
            'image' => $image ? $image->photo : null,
            'name' => $product ? $product->name : null,
            'price' => $product ? $product->price : null,
            'buyer' => [
                'id' => $buyer ? $buyer->id : null,
                'username'=> $buyer ? $buyer->username : null,
                'email'=> $buyer ? $buyer->email : null,
                'phone'=> $buyer ? $buyer->phone : null,
                'address'=> $buyer ? $buyer->address : null,
                'image' => $buyer ? $buyer->image : null,
            ]
        ];
    }
}
