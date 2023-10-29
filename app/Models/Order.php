<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'product_id',
        'name',
        'email',
        'quantity',
        'price',
        'stripe_customer_id',
        'stripe_charge_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
