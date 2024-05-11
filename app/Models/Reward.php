<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reward extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer_id',
        'seller_id',
        'point',
    ];
    public function buyer(): BelongsTo
    {
        return $this->belongsTo(Buyer::class);
    }
    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }
}
