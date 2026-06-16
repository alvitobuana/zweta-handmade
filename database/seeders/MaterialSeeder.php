<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Material;

class MaterialSeeder extends Seeder
{
    public function run(): void
    {
        $materials = [
            ['Kain kanvas', 'Kain', 20, 5, 'aman'],
            ['Tali tas', 'Aksesoris', 18, 5, 'menipis'],
            ['Resleting', 'Aksesoris', 16, 5, 'habis'],
            ['Benang', 'Benang', 14, 5, 'aman'],
            ['Label kulit', 'Branding', 12, 5, 'menipis'],
            ['Kancing', 'Aksesoris', 10, 5, 'habis'],
            ['Aksesoris', 'Dekorasi', 8, 5, 'aman'],
        ];

        foreach ($materials as $m) {
            Material::create([
                'name' => $m[0],
                'type' => $m[1],
                'quantity' => $m[2],
                'min_stock' => $m[3],
                'status' => $m[4],
            ]);
        }
    }
}
