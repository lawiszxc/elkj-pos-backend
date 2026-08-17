<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Remittance extends Model
{
    protected $fillable = [
        'user_id',
        'cash_remitted',
        'status'
    ];
}
