<?php

namespace App\Models;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function product_category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
    }
}
