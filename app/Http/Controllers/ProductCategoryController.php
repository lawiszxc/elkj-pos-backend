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
            'status' => 'Active',
        ]);

        return response()->json($addCategory, 200);
    }

    public function getCategory()
    {
        $category = ProductCategory::with('products')->orderBy('name', 'ASC')->get();

        return response()->json($category);
    }

    public function updateCategory(Request $request, $id)
    {
        $category = ProductCategory::findOrFail($id);

        $category->update($request->only([
            'name',
            'description',
            'status',
        ]));

        return response()->json($category);
    }

    // $updateCategory->update([
    //     'name' => $request->name || null,
    //     'description' => $request->description || null,
    //     'status' => $request->status || null,
    // ]);

    public function deleteCategory($id)
    {
        $deleteCategory = ProductCategory::find($id);
        $deleteCategory->delete();

        return response()->json($deleteCategory, 200);
    }
}
