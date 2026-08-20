<?php

namespace App\Http\Controllers;

use App\Models\ProductReturn;
use App\Models\ProductStock;
use App\Models\Remittance;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class POSController extends Controller
{
    public function addSale(Request $request)
    {
        $sale = Sale::create([
            'user_id' => Auth::user()->id,
            'customer_name' => $request->customer_name,
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
            'status' => 'Completed',
        ]);

        $sale->update([
            'invoice_number' => 'INV-' . str_pad(
                $sale->id,
                6,
                '0',
                STR_PAD_LEFT
            ),
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

        $remittance = Remittance::create([
            'user_id' => Auth::user()->id,
            'sale_id' => $sale->id,
            'status' => 'Pending',
        ]);

        return response()->json([
            'sale' => $sale,
            'sale_items' => $sale->sale_items,
            'remittance' => $remittance,
        ], 200);
    }

    public function getSales()
    {
        $sales = Sale::with([
            'sale_items.product',
            'user'
        ])
            ->orderByDesc('invoice_number')
            ->get();

        return response()->json($sales);
    }

    public function returnSaleItem(
        Request $request,
        SaleItem $saleItem
    ) {
        $request->validate([
            'quantity' => [
                'required',
                'integer',
                'min:1',
            ],

            'status' => [
                'required',
                'string',
                'max:255',
            ],
        ]);

        $quantity = (int) $request->quantity;
        $status = $request->status;

        if ($quantity > $saleItem->quantity) {
            return response()->json([
                'message' =>
                    'Return quantity cannot exceed the sold quantity.',
            ], 422);
        }

        DB::transaction(function () use ($saleItem, $quantity, $status) {
            /*
            |--------------------------------------------------------------------------
            | Reduce Sold Quantity
            |--------------------------------------------------------------------------
            */

            $saleItem->quantity -= $quantity;

            $saleItem->save();

            /*
            |--------------------------------------------------------------------------
            | Add Returned Stock
            |--------------------------------------------------------------------------
            */

            ProductReturn::create([
                'product_id' => $saleItem->product_id,
                'quantity' => $quantity,
                'status' => $status,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Update Sale Status
            |--------------------------------------------------------------------------
            */

            $sale = $saleItem->sale;

            /*
            | Check all sale items after the return.
            |
            | If all quantities are 0:
            |     Returned
            |
            | If some quantities are still greater than 0:
            |     Partially Returned
            |
            */

            $remainingItems = $sale->sale_items()
                ->where('quantity', '>', 0)
                ->exists();

            if ($remainingItems) {
                $sale->update([
                    'status' => 'Partially Returned',
                ]);
            } else {
                $sale->update([
                    'status' => 'Returned',
                ]);
            }
        });

        return response()->json([
            'message' => 'Item returned successfully.',
            'sale_item' => $saleItem->fresh(),
            'sale' => $saleItem->sale->fresh(),
        ]);
    }

    public function returnAllSaleItems(
        Request $request,
        Sale $sale
    ) {
        $request->validate([
            'status' => [
                'required',
                'string',
                'max:255',
            ],
        ]);

        $status = $request->status;

        DB::transaction(function () use ($sale, $status) {
            $saleItems = $sale->sale_items()
                ->where('quantity', '>', 0)
                ->get();

            if ($saleItems->isEmpty()) {
                abort(
                    response()->json([
                        'message' => 'All items in this sale have already been returned.',
                    ], 422)
                );
            }

            foreach ($saleItems as $saleItem) {
                $quantity = $saleItem->quantity;

                // Add returned stock
                ProductReturn::create([
                    'product_id' => $saleItem->product_id,
                    'quantity' => $quantity,
                    'status' => $status,
                ]);

                // Set remaining sold quantity to 0
                $saleItem->quantity = 0;
                $saleItem->save();
            }

            // Update sale status
            $sale->update([
                'status' => 'Returned',
            ]);
        });

        return response()->json([
            'message' => 'All sale items returned successfully.',
            'sale' => $sale->fresh([
                'sale_items.product',
                'user',
            ]),
        ]);
    }
}
