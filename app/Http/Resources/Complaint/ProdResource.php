<?php

namespace App\Http\Resources\Complaint;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProdResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $buyer = $this->buyer;
        $product = Product::find($this->about_id);
        $seller = $product? $product->seller : null ;
        $images = $product ? $product->photos->pluck('photo') : null ;
        return [
            'id' => $this->id,
            'about' => $this->about ,
            'complainer_username' => $buyer->username ,
            'complainer_email' => $buyer->email ,
            'complainer_id' => $buyer->id ,
            'title' => $this->title ,
            'body' => $this->body ,
            'id_product' => $product ? $product->id :null ,
            'name_product' => $product?  $product->name : null ,
            'seller_id' => $seller ? $seller->id : null ,
            'seller_username' => $seller ? $seller->buyer->username : null ,
            'images_product' => $images ? $images : null ,
            'rating_avg' =>$product? $product->rating_avg  : null,
            'price' =>$product? $product->price : null ,
        ];
    }
}
