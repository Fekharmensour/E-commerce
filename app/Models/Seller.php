<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seller extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer_id',
        'commercialRecord',
        'brand_id',
        'is_owner',
        'status'
    ];
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
    public function buyer():BelongsTo
    {
        return $this->belongsTo(Buyer::class);
    }
    public function brand():BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}
