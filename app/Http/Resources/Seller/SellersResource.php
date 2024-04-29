<?php

namespace App\Http\Resources\Seller;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SellersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $brand = $this->brand ;
        $buyer = $this->buyer ;
        return [
            'id' => $this->id,
            'username' => $buyer->username ,
            'email' => $buyer->email ,
            'brand_name' => $brand->name ,
            'image' => $buyer->image ,
            'status' => $this->status ,
            'is_owner' =>$this->is_owner,
            'brand_logo' => $brand->logo,
        ];
    }
}
