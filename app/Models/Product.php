<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'quantity',
        'rating_avg',
        'description',
        'seller_id',
        'category_id'
    ];

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function seller():BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }
    public function photos():HasMany
    {
        return $this->hasMany(Photo::class);
    }
    public function cart():HasMany
    {
        return $this->hasMany(Cart::class) ;
    }
}
