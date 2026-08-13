<?php

namespace App\Http\Controllers;

use App\Models\ProductStock;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductStockController extends Controller
{
    public function getProductStocks()
    {
        $getProductStocks = ProductStock::with('product.product_category')->orderByDesc('created_at')->get();

        return response()->json($getProductStocks);
    }

    public function addProductStock(Request $request)
    {
        $addProductStock = ProductStock::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'reorder_level' => $request->reorder_level,
            'created_at' => $request->created_at ?? Carbon::now(),
        ]);

        return response()->json($addProductStock);
    }
}
