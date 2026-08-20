<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'role' => 'Administrator',
            'email' => 'elkj@gmail.com',
            'password' => Hash::make('123123'),
        ]);

        User::factory()->create([
            'role' => 'Cashier',
            'email' => 'mark@gmail.com',
            'password' => Hash::make('123123'),
        ]);

        $this->call(ProductCategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductStockSeeder::class);
    }
}
