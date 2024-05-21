<?php

namespace App\Http\Resources;

use App\Models\Buyer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoitficationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $sender = Buyer::find($this->sender);
        return [
            'id' => $this->id,
            'sender' =>$sender? $sender->username : null ,
            'sender_image' => $sender ? $sender->image : null ,
            'receiver' => $this->receiver,
            'body' => $this->body,
            'title' => $this->title,
            'status' => $this->status,
        ];
    }
}
