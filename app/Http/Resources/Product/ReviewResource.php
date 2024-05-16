<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $buyer = $this->buyer ;
        return [
            'id' => $this->id ,
            'username' => $buyer->username ,
            'image' => $buyer->image ,
            'id_buyer' => $buyer->id ,
            'content' => $this->content ,
            'rating'=> $this->rating ,
        ];
    }
}
