<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdersResource extends JsonResource
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
        return [
            'id' => $this->id,
            'qte' => $cart->qte,
            'accepted'=> $this->accepted,
            'image' => $image ? $image->photo : null,
            'name' => $product ? $product->name : null,
            'price' => $product ? $product->price : null,
            'seller_id' => $seller ? $seller->id : null,
        ];
    }
}
