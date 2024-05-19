<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand_id',
        'coupon',
        'percentage',
        'dateE'
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    protected $casts = [
        'dateE' =>'date',
    ];
    protected static function booted()
    {
        static::saving(function ($coupon) {
            if ($coupon->dateE && $coupon->dateE->lte(Carbon::today())) {
                $coupon->delete();
            }
        });
    }
}
