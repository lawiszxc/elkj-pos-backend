<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Remittance extends Model
{
    protected $fillable = [
        'user_id',
        'sale_id',
        'cash_remitted',
        'status',
        'updated_at'
    ];

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class, 'sale_id', 'id');
    }

    public function remittance_details(): HasMany
    {
        return $this->hasMany(RemittanceDetail::class, 'date_remitted', 'updated_at');
    }


}

