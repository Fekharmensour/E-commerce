<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Complaint extends Model
{
    use HasFactory;
    protected $fillable = [
        'buyer_id',
        'about_id',
        'about',
        'title',
        'body'
    ] ;
    public function buyer(): BelongsTo
    {
        return $this->belongsTo(Buyer::class);
    }
}
