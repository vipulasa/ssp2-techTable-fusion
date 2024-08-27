<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'total',
        'is_paid',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // create service_charge attribute
    public function getServiceChargeAttribute()
    {
        return round($this->total * 0.05, 2);
    }

    public function products()
    {
        return $this
            ->belongsToMany(Product::class, 'cart_product')
            ->withPivot([
                'quantity',
                'total'
            ]);
    }
}
