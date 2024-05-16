<?php

namespace App\Http\Resources\Complaint;

use App\Models\Review;
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
        $buyer = $this->buyer;
        $review = Review::find($this->about_id);
        $product = $review ? $review->product : null;
        $image = $product ? $product->photos()->first() : null;
        $writer_review = $review ? $review->buyer : null;
        return [
            'id' => $this->id,
            'about' => $this->about ,
            'complainer_username' => $buyer->username ,
            'complainer_id' => $buyer->id ,
            'complainer_email' => $buyer->email ,
            'title' => $this->title ,
            'body' => $this->body ,
            'name_product' => $product ? $product->name : null ,
            'image_product' => $image ? $image->path : null ,
            'price' => $product ? $product->price : null ,
            'content_review' => $review ? $review->content : null ,
            'rating' => $review ? $review->rating : null ,
            'writer_review_id' => $writer_review ? $writer_review->id : null ,
            'review_id'=>$review ? $review->id : null ,
            'writer_review_name' => $writer_review ? $writer_review->username : null ,
        ];
    }
}
