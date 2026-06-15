<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CustomRequest;

class CustomRequestSeeder extends Seeder
{
    public function run(): void
    {
        $samples = [
            ['Aulia','aulia@example.com','0812xxxx','Tote Bag','Cocoa','Tambah inisial ZK','menunggu','2026-06-20'],
            ['Rani','rani@example.com','0812yyyy','Sling','Cream','Ganti ukuran medium','menunggu','2026-06-22'],
        ];

        foreach ($samples as $s) {
            CustomRequest::create([
                'customer_name' => $s[0],
                'email' => $s[1],
                'phone' => $s[2],
                'model' => $s[3],
                'color' => $s[4],
                'notes' => $s[5],
                'status' => $s[6],
                'deadline' => $s[7],
            ]);
        }
    }
}
