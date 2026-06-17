<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $samples = [
            ['Tote Terra', 'tote-terra', 'Tote bag canvas', 125000, 8, 'ready', 'Totebag', 'uploads/products/1781609879_WhatsApp Image 2026-06-15 at 21.35.02.jpeg'],
            ['Sling Latte', 'sling-latte', 'Sling bag simple', 85000, 12, 'ready', 'Sling Bag', 'uploads/products/1781609864_WhatsApp Image 2026-06-15 at 21.35.02 (1).jpeg'],
            ['Pouch Rose', 'pouch-rose', 'Pouch small', 85000, 5, 'pre-order', 'Sling Bag', 'uploads/products/1781609785_WhatsApp Image 2026-06-15 at 21.35.03.jpeg'],
            ['Mini Sage', 'mini-sage', 'Mini bag', 85000, 4, 'custom', 'Backpack', 'uploads/products/1781609830_WhatsApp Image 2026-06-15 at 21.36.55.jpeg'],
            ['Daily Cocoa', 'daily-cocoa', 'Daily use bag', 85000, 6, 'ready', 'Backpack', 'uploads/products/1781609840_WhatsApp Image 2026-06-15 at 21.36.56 (1).jpeg'],
            ['Bag Cream', 'bag-cream', 'Cream colored bag', 85000, 3, 'ready', 'Totebag', 'uploads/products/1781609850_WhatsApp Image 2026-06-15 at 21.36.57 (2).jpeg'],
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
                'image' => $s[7],
            ]);
        }
    }
}
