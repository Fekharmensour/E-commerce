<?php

namespace App\Http\Resources\Brand;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowBrandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $sellerCount = $this->sellers->count();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'logo' => $this->logo,
            'background_image' => $this->background_image,
            'seller_count' => $sellerCount,
            'sellers' => $this->sellers->map(function ($seller) {
                return [
                    'id' => $seller->id,
                    'commercialRecord' => $seller->commercialRecord,
                    'is_owner' => $seller->is_owner,
                    'username' => $seller->buyer->username,
                    'image' => $seller->buyer->image,
                ];
            }),
        ];
    }
}
