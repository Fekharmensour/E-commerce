<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'background_image',
        'status',
        'logo'
    ];
    public function sellers():HasMany
    {
        return $this->HasMany(Seller::class);
    }
    public function coupons():HasMany
    {
        return $this->HasMany(Coupon::class);
    }
}
