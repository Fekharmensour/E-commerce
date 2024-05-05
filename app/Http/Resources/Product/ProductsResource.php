<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'id'=>$this->id ,
            'price' => $this->price,
            'rating_avg' => $this->rating_avg,
            'description' => $this->description,
            'category_id' => $this->category->id,
            'seller_id' => $this->seller->id,
            'photos' => $this->photos->pluck('photo'),
        ];
    }

}
