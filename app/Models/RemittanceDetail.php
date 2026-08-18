<?php

namespace App\Models;

use App\Models\Remittance;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RemittanceDetail extends Model
{
    protected $fillable = [
        "remitted_to",
        "reference_number",
        "date_remitted",
    ];

    public function remittance(): BelongsTo
    {
        return $this->belongsTo(Remittance::class, 'date_remitted', 'updated_at');
    }

}
