<?php

namespace App\Http\Resources\Buyer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BuyerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
//        $seller = $this->seller();

        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'birthday' => $this->birthday,
            'role' => $this->role,
            'is_admin' => $this->is_admin,
            'phone' => $this->phone,
            'address' => $this->address,
            'image' => $this->image,
        ];
    }
}
