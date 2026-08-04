<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{

    public function addCategory(Request $request)
    {
        $addCategory = ProductCategory::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => 'Active'
        ]);

        return response()->json($addCategory, 200);
    }

    public function getCategory()
    {
        $category = ProductCategory::orderBy('name', 'ASC')->get();

        return response()->json($category);
    }
}
