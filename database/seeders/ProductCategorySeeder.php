<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductCategory::insert([
            [
                'name' => 'Computers & Laptops',
                'description' => 'Desktop computers and laptops.',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Desktop Components',
                'description' => 'Internal PC components such as CPUs, motherboards, GPUs, and cases.',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Computer Peripherals',
                'description' => 'External computer devices and accessories.',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Keyboards & Mice',
                'description' => 'Wired, wireless, and gaming keyboards and mice.',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Printers & Scanners',
                'description' => 'Printers, scanners, and multifunction devices.',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Printer Ink & Toner',
                'description' => 'Ink cartridges, toner cartridges, and printer supplies.',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Storage Devices (SSD, HDD, USB)',
                'description' => 'SSDs, hard drives, USB flash drives, and memory cards.',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Memory (RAM)',
                'description' => 'Desktop and laptop RAM modules.',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Networking Equipment',
                'description' => 'Networking devices for home and business use.',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Routers & Switches',
                'description' => 'Routers, switches, access points, and network hubs.',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'CCTV & Security',
                'description' => 'CCTV cameras, DVRs, NVRs, and security systems.',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Cables & Adapters',
                'description' => 'HDMI, USB, LAN, VGA, DisplayPort, and power adapters.',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Power Supplies & UPS',
                'description' => 'Power supply units and uninterrupted power supplies.',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Audio & Headsets',
                'description' => 'Speakers, headphones, microphones, and headsets.',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Mobile Accessories',
                'description' => 'Chargers, cases, cables, screen protectors, and phone accessories.',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Batteries & Chargers',
                'description' => 'Rechargeable batteries, adapters, and charging devices.',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Office Equipment',
                'description' => 'Office electronics and workplace accessories.',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Cleaning & Maintenance',
                'description' => 'Cleaning kits and maintenance tools for IT equipment.',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Tools & Repair Parts',
                'description' => 'Repair tools, spare parts, and maintenance accessories.',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Software & Licenses',
                'description' => 'Operating systems, productivity software, antivirus, and software licenses.',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
