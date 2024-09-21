<?php

namespace Database\Seeders;

use App\Models\Inventory;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(10)
            ->has(
                Inventory::factory()->times(rand(60, 99))
            )
            ->create();

        User::factory()
            ->hasInventories(100)
            ->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
    }
}
