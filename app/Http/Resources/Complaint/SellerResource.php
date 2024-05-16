<?php

namespace App\Http\Resources\Complaint;

use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SellerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $complainer_buyer = $this->buyer;
        $seller = Seller::find($this->about_id);
        $buyer = $seller ? $seller->buyer : null;
        $brand = $seller ? $seller->brand : null;
        return [
            'about' => $this->about ,
            'id' => $this->id,
            'complainer_username' => $complainer_buyer->username ,
            'complainer_id' => $complainer_buyer->id ,
            'complainer_email' => $complainer_buyer->email ,
            'title' => $this->title ,
            'body' => $this->body ,
            'seller_username' =>$buyer? $buyer->username : null ,
            'seller_email' =>$buyer? $buyer->email : null ,
            'seller_id' =>$buyer? $seller->id :null,
            'brand'=> $brand? $brand->name : null,
        ];
    }
}
