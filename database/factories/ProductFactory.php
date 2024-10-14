<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => fake()->uuid(),
            'name' => fake()->name(),
            'description' => fake()->text(),
            'thumbnail' => fake()->imageUrl(),
            'price' => fake()->numberBetween(1000, 1000000),
            'stock' => fake()->numberBetween(1, 1000),
            'category_id' => Category::all()->random()->id,
            'sub_category_id' => SubCategory::all()->random()->id,
            'product_galleries' => fake()->imageUrl(),
            'slug' => fake()->slug(),
            'is_active' => fake()->boolean(),
            'is_featured' => fake()->boolean(),
            'user_id' => User::all()->random()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}