<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_category_id',
        'supplier_id',
        'sku',
        'varcode',
        'product_name',
        'description',
        'cost_price',
        'selling_price',
        'image',
        'status',
    ];
}
