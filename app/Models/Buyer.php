<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Buyer extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable , HasApiTokens;

    protected $fillable = [
        'username',
        'email',
        'password',
        'address',
        'phone',
        'role',
        'is-admin',
        'image'
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function seller():HasOne
    {
        return $this->hasOne(Seller::class);
    }
    public function carts():HasMany
    {
        return $this->hasMany(Cart::class) ;
    }
    public function orders():HasMany
    {
        return $this->hasMany(Order::class) ;
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function rewards():HasMany
    {
       return $this->hasMany(Reward::class);
    }
    public function reviews():HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function complaints():HasMany
    {
        return $this->hasMany(Complaint::class);
    }
}
