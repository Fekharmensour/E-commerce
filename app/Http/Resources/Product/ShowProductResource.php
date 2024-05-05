<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        $category = $this->category;
        $seller = $this->seller;
        $brand = $seller->brand;

        return [
            'name' => $this->name,
            'id' =>$this->id,
            'price' => $this->price,
            'rating_avg' => $this->rating_avg,
            'description' => $this->description,
            'category_id' => $category->id,
            'category' => $category->name,
            'brand_id' => $brand->id,
            'brand_name' => $brand->name,
            'seller_id' => $seller->id,
            'seller_username' => $seller->buyer->username,
            'seller_phone' => $seller->buyer->phone,
            'seller_email' => $seller->buyer->email,
            'seller_address' => $seller->buyer->address,
            'seller_image' => $seller->buyer->image,
            'photos' => $this->photos->pluck('photo'),
        ];
    }
}
