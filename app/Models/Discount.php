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
            // Convert dateE to a Carbon instance before using lte()
            $discountDateE = Carbon::parse($discount->dateE);
            if ($discount->dateE && $discountDateE->lte(Carbon::today())) {
                $discount->delete();
            }
        });
    }
    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }
}
