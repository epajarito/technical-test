<?php

namespace Database\Factories;

use App\Models\Inventory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class InventoryFactory extends Factory
{
    protected $model = Inventory::class;

    public function definition(): array
    {
        return [
            'name' => fake()->sentence,
            'description' => fake()->text(),
            'quantity' => rand(75, 100),
            'price' => fake()->randomFloat(),
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'updated_at' => fake()->dateTimeBetween('-1 year', 'now'),

//            'user_id' => User::factory(),
        ];
    }
}
