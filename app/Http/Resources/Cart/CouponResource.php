<?php

namespace App\Http\Resources\Cart;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $brand = $this->brand ;
        return [
            'id' => $this->id,
            'coupon'=>$this->coupon,
            'percentage'=> $this->percentage,
            'dateE'=> $this->dateE,
            'brand_name'=> $brand ? $brand->name : '',
            'brand_id'=> $brand ? $brand->id : '',
            'brand_image'=> $brand ? $brand->logo : '',
        ];
    }
}
