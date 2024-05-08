<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'id'=>$this->id ,
            'price' => $this->price,
            'rating_avg' => $this->rating_avg,
            'description' => $this->description,
            'category_id' => $this->category->id,
            'photos' => $this->photos->pluck('photo'),
            'quantity' => $this->quantity
        ];
    }
}
