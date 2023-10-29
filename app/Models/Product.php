<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected const DEFAULT_CURRENCY = '$';

    protected $casts = [
        'price' => 'decimal:2',
    ];

    protected $append = [
        'formatted_price',
    ];

    public function getFormattedPriceAttribute() : string
    {
        return self::DEFAULT_CURRENCY . number_format($this->price ?? 0, 2);
    }

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function isOutOfStock() : bool
    {
        return $this->quantity <= 0;
    }
}
