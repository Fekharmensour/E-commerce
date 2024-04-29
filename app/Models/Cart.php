<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'buyer_id',
        'qte' ,
        'is_ordered'
    ];

    public function product():HasOne
    {
        return $this->hasOne(Product::class) ;
    }
    public function orders():HasMany
    {
        return $this->hasMany(Order::class) ;
    }

    public function buyer():BelongsTo
    {
        return $this->belongsTo(Buyer::class) ;
    }
}
