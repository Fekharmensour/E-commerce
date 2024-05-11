<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id' ,
        'discount',
        'max_discount' ,
        'dateE'
    ];
    protected static function booted()
    {
        static::saving(function ($discount) {
            if ($discount->dateE && $discount->dateE->lte(Carbon::today())) {
                $discount->delete();
            }
        });
    }
    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }
}
