<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class POSController extends Controller
{
    public function addSale(Request $request)
    {
        $sale = Sale::create([
            'user_id' => Auth::user()->id,
            'customer_id' => $request->customer_id,
            'subtotal' => $request->subtotal,
            'discount' => $request->discount,
            'tax' => $request->tax,
            'total_amount' => $request->total_amount,
            'payment_method' => $request->payment_method,
            'amount_paid' => $request->amount_paid,
            'change_amount' => max(
                $request->amount_paid - $request->total_amount,
                0
            ),
            'status' => 'Done',
        ]);

        $sale->update([
            'invoice_number' => 'INV-' . str_pad($sale->id, 6, '0', STR_PAD_LEFT),
        ]);


        foreach ($request->sale_items as $item) {
            $sale->sale_items()->create([
                'product_id' => $item['product_id'],
                'sale_id' => $sale->id,
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'subtotal' => $item['unit_price'] * $item['quantity'],
            ]);
        }

        return response()->json([
            'sale' => $sale,
            'sale_items' => $sale->sale_items,
        ], 200);
    }
}
