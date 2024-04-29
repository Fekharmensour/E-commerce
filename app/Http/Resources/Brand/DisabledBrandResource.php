<?php

namespace App\Http\Resources\Brand;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DisabledBrandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $seller = $this->sellers->first();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'logo' => $this->logo,
            'background_image' => $this->background_image,
            'seller' => [
                'id' => $seller->id,
                'commercialRecord' => $seller->commercialRecord,
                'is_owner' => $seller->is_owner
            ]
        ];
    }
}
