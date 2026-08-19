<?php

namespace Database\Seeders;

use App\Models\ProductStock;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductStock::insert([
            [
                "product_id" => "7",
                "quantity" => 10,
                "status" => 'Received',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                "product_id" => "10",
                "quantity" => 8,
                "status" => 'Received',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                "product_id" => "4",
                "quantity" => 10,
                "status" => 'Received',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                "product_id" => "12",
                "quantity" => 8,
                "status" => 'Received',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                "product_id" => "15",
                "quantity" => 9,
                "status" => 'Received',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                "product_id" => "13",
                "quantity" => 16,
                "status" => 'Received',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
