<?php

namespace App\Http\Resources\Complaint;

use App\Models\Buyer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BuyerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $complainer_buyer = $this->buyer;
        $buyer = Buyer::find($this->about_id);
        return [
            'about' => $this->about ,
            'id' => $this->id,
            'complainer_username' => $complainer_buyer->username ,
            'complainer_id' => $complainer_buyer->id ,
            'complainer_email' => $complainer_buyer->email ,
            'title' => $this->title ,
            'body' => $this->body ,
            'buyer_id' =>$buyer ? $buyer->id : null ,
            'buyer_username' =>$buyer ? $buyer->username : null ,
            'buyer_email' =>$buyer ? $buyer->email : null

        ];
    }
}
