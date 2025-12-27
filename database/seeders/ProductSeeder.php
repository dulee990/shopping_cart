<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::query()->delete();

        Product::insert([
            ['name' => 'Keyboard',        'price' => 49.99,  'stock_quantity' => 20, 'created_at'=>now(), 'updated_at'=>now()],
            ['name' => 'Mouse',           'price' => 19.99,  'stock_quantity' => 50, 'created_at'=>now(), 'updated_at'=>now()],
            ['name' => 'Monitor',         'price' => 199.99, 'stock_quantity' => 8,  'created_at'=>now(), 'updated_at'=>now()],
            ['name' => 'USB-C Cable',     'price' => 9.99,   'stock_quantity' => 4,  'created_at'=>now(), 'updated_at'=>now()],
            ['name' => 'Laptop Stand',    'price' => 29.99,  'stock_quantity' => 12, 'created_at'=>now(), 'updated_at'=>now()],
            ['name' => 'Webcam',          'price' => 59.99,  'stock_quantity' => 7,  'created_at'=>now(), 'updated_at'=>now()],
            ['name' => 'Headset',         'price' => 79.99,  'stock_quantity' => 15, 'created_at'=>now(), 'updated_at'=>now()],
            ['name' => 'Desk Lamp',       'price' => 24.99,  'stock_quantity' => 9,  'created_at'=>now(), 'updated_at'=>now()],
            ['name' => 'HDMI Cable',      'price' => 12.99,  'stock_quantity' => 30, 'created_at'=>now(), 'updated_at'=>now()],
            ['name' => 'Portable SSD',    'price' => 109.99, 'stock_quantity' => 3,  'created_at'=>now(), 'updated_at'=>now()],
            ['name' => 'Wi-Fi Adapter',   'price' => 14.99,  'stock_quantity' => 22, 'created_at'=>now(), 'updated_at'=>now()],
            ['name' => 'USB Hub',         'price' => 18.99,  'stock_quantity' => 10, 'created_at'=>now(), 'updated_at'=>now()],
            ['name' => 'Mouse Pad',       'price' => 6.99,   'stock_quantity' => 40, 'created_at'=>now(), 'updated_at'=>now()],
        ]);
    }
}
