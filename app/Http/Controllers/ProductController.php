<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProducts()
    {
        $products = Product::with(['product_category', 'sale_items', 'product_stocks'])->orderBy('product_name', 'ASC')->get();

        return response()->json($products);
    }

    public function addProduct(Request $request)
    {
        $products = Product::create([
            'product_category_id' => $request->product_category_id,
            'supplier_id' => $request->supplier_id,
            'sku' => $request->sku,
            'varcode' => $request->varcode,
            'product_name' => $request->product_name,
            'description' => $request->description,
            'cost_price' => $request->cost_price,
            'selling_price' => $request->selling_price,
            'image' => "https://i0.wp.com/picjumbo.com/wp-content/uploads/detailed-shot-of-ripples-at-sunset-free-image.jpeg?w=600&quality=80",
            'status' => "Available",
        ]);

        return response()->json($products);
    }

    public function deleteProduct($id)
    {
        $deleteProduct = Product::findOrFail($id);
        $deleteProduct->delete();

        return response()->json($deleteProduct, 200);

    }
}
