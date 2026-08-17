<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $today = now()->startOfDay();

        // =====================================================
        // TODAY'S SALES
        // =====================================================
        $todaySales = Sale::where('created_at', '>=', $today)
            ->sum('total_amount');

        // =====================================================
        // TODAY'S TRANSACTIONS
        // =====================================================
        $todayTransactions = Sale::where('created_at', '>=', $today)
            ->count();

        // =====================================================
        // TODAY'S ITEMS SOLD
        // =====================================================
        $todayItemsSold = SaleItem::whereHas('sale', function ($query) use ($today) {
            $query->where('created_at', '>=', $today);
        })->sum('quantity');

        // =====================================================
        // LOW STOCK
        //
        // Low Stock:
        // Available Stock <= 30% of Reorder Level
        //
        // Available Stock:
        // Total Received - Total Sold
        // =====================================================
        $lowStocks = 0;

        $products = Product::with([
            'product_stocks',
            'sale_items',
        ])->get();

        foreach ($products as $product) {

            $totalReceived = $product->product_stocks->sum('quantity');

            $totalSold = $product->sale_items->sum('quantity');

            $availableStock = max(0, $totalReceived - $totalSold);

            $reorderLevel = (float) $product->reorder_level;

            // Avoid invalid reorder level
            if ($reorderLevel <= 0) {
                continue;
            }

            // 30% of reorder level
            $lowStockLimit = $reorderLevel * 0.30;

            // Do not count Out of Stock as Low Stock
            if (
                $availableStock > 0 &&
                $availableStock <= $lowStockLimit
            ) {
                $lowStocks++;
            }
        }

        return response()->json([
            'today_sales' => $todaySales,
            'today_transactions' => $todayTransactions,
            'today_items_sold' => $todayItemsSold,
            'low_stocks' => $lowStocks,
        ]);
    }
}
