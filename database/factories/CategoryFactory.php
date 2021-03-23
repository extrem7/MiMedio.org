<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->sentence(2);
        return [
            'name' => $name,
            'slug' => \Str::slug($name),
        ];
    }
}
