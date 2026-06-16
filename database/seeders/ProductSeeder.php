<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $samples = [
            ['Tote Terra', 'tote-terra', 'Tote bag canvas', 125000, 8, 'ready', 'Totebag'],
            ['Sling Latte', 'sling-latte', 'Sling bag simple', 85000, 12, 'ready', 'Sling Bag'],
            ['Pouch Rose', 'pouch-rose', 'Pouch small', 85000, 5, 'pre-order', 'Sling Bag'],
            ['Mini Sage', 'mini-sage', 'Mini bag', 85000, 4, 'custom', 'Backpack'],
            ['Daily Cocoa', 'daily-cocoa', 'Daily use bag', 85000, 6, 'ready', 'Backpack'],
            ['Bag Cream', 'bag-cream', 'Cream colored bag', 85000, 3, 'ready', 'Totebag'],
        ];

        foreach ($samples as $s) {
            Product::create([
                'name' => $s[0],
                'slug' => $s[1],
                'description' => $s[2],
                'price' => $s[3],
                'stock' => $s[4],
                'status' => $s[5],
                'category' => $s[6],
            ]);
        }
    }
}
