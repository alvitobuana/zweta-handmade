<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin Zweta',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        // sample products
        $this->call([
            \Database\Seeders\ProductSeeder::class,
            \Database\Seeders\OrderSeeder::class,
            \Database\Seeders\CustomRequestSeeder::class,
            \Database\Seeders\CustomerSeeder::class,
            \Database\Seeders\MaterialSeeder::class,
        ]);
    }
}
