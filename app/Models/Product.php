<?php

namespace App\Models;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'reorder_level',
        'image',
        'status',
    ];

    public function product_category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
    }

    public function product_stocks(): HasMany
    {
        return $this->hasMany(ProductStock::class, 'product_id', 'id');
    }

    public function sale_items(): HasMany
    {
        return $this->hasMany(SaleItem::class, 'product_id', 'id');
    }
}
