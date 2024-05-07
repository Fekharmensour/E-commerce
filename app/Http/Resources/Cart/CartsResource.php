<?php

namespace App\Http\Resources\Cart;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $product = Product::find($this->product_id);
        $image = $product ? $product->photos()->first() : null;

        return [
            'id' => $this->id,
            'qte' => $this->qte,
            'is_ordered'=>$this->is_ordered,
            'product_id' => $product? $product->id :null,
            'image' => $image ? $image->photo : null,
            'name' => $product ? $product->name : null,
            'price' => $product ? $product->price : null,
        ];
    }
}
