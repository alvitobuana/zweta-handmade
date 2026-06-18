<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CustomRequest;

class CustomRequestSeeder extends Seeder
{
    public function run(): void
    {
        $samples = [
            ['ZW-CST-7GQLK','Aulia','aulia@example.com','0812xxxx','Tote Bag','Cocoa','Tambah inisial ZK','menunggu','2026-06-20'],
            ['ZW-CST-3M8XY','Rani','rani@example.com','0812yyyy','Sling','Cream','Ganti ukuran medium','menunggu','2026-06-22'],
        ];

        foreach ($samples as $s) {
            CustomRequest::create([
                'code' => $s[0],
                'customer_name' => $s[1],
                'email' => $s[2],
                'phone' => $s[3],
                'model' => $s[4],
                'color' => $s[5],
                'notes' => $s[6],
                'status' => $s[7],
                'deadline' => $s[8],
            ]);
        }
    }
}
