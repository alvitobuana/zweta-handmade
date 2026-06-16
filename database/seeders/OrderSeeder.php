<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $samples = [
            ['ZW-24001','Aulia','Tote Terra',1,165000,'produksi',''],
            ['ZW-24002','Rani','Sling Latte',1,125000,'pending',''],
        ];

        foreach ($samples as $s) {
            Order::create([
                'code' => $s[0],
                'customer_name' => $s[1],
                'product' => $s[2],
                'qty' => $s[3],
                'price' => $s[4],
                'status' => $s[5],
                'notes' => $s[6],
            ]);
        }
    }
}
