<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    protected $fillable = [
        'user_id',
        'customer_id',
        'invoice_number',
        'subtotal',
        'discount',
        'tax',
        'total_amount',
        'payment_method',
        'amount_paid',
        'change_amount',
        'status'
    ];

    public function sale_items(): HasMany
    {
        return $this->hasMany(SaleItem::class, 'sale_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function remittance(): HasMany
    {
        return $this->hasMany(Remittance::class, 'sale_id', 'id');
    }
}
