<?php

namespace App\Http\Controllers;

use App\Models\ProductReturn;
use Illuminate\Http\Request;

class ProductReturnController extends Controller
{
    public function getProductReturns()
    {
        $getReturn = ProductReturn::with('product.product_category')->orderByDesc('created_at')->get();

        return response()->json($getReturn);
    }
}
