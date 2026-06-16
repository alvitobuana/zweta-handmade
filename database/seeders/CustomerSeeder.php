<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            ['Aulia', 'aulia@example.com', '0812xxxx', 1, 150000],
            ['Rani', 'rani@example.com', '0812yyyy', 2, 230000],
            ['Nadya', 'nadya@example.com', '0812zzzz', 3, 310000],
            ['Salsa', 'salsa@example.com', '0812aaaa', 4, 360000],
            ['Maya', 'maya@example.com', '0812bbbb', 5, 470000],
            ['Sarah', 'sarah@example.com', '0812cccc', 6, 550000],
        ];

        foreach ($customers as $c) {
            Customer::create([
                'name' => $c[0],
                'email' => $c[1],
                'phone' => $c[2],
                'total_orders' => $c[3],
                'total_spent' => $c[4],
            ]);
        }
    }
}
