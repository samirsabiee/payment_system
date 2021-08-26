<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->numberBetween(200, 1000),
            'image' => "https://picsum.photos/id/" . $this->faker->numberBetween(1, 100) . "/400",
            'stock' => $this->faker->numberBetween(0, 10)
        ];
    }
}
