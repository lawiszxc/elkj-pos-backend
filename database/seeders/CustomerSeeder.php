<?php

namespace Database\Seeders;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::insert([
            [
                'customer_code' => 'ML2354235',
                'name' => 'Mark Laurence Lawis',
                'phone' => '09758469156',
                'address' => 'Opol Misamis',
                'email' => 'mark@gmail.com',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'customer_code' => 'RL2354235',
                'name' => 'Ryanle Lawis',
                'phone' => '09758469156',
                'address' => 'Opol Misamis',
                'email' => 'ryan@gmail.com',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
