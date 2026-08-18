<?php

namespace App\Http\Controllers;

use App\Models\InternalUse;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InternalUseController extends Controller
{
    public function getInternalUses()
    {
        $getInternalUse = InternalUse::with('product.product_category')->orderByDesc('created_at')->get();

        return response()->json($getInternalUse);
    }

    public function addInternalUse(Request $request)
    {
        $addInternalUse = InternalUse::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'created_at' => $request->created_at ?? Carbon::now(),
        ]);

        return response()->json($addInternalUse);
    }
}
