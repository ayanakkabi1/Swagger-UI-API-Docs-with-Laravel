<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Banana>
 */
class BananaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $bananaVarieties = [
            'Cavendish Banana',
            'Plantain',
            'Red Banana',
            'Lady Finger Banana',
            'Gros Michel',
            'Blue Java Banana',
            'Goldfinger Banana',
            'Burro Banana',
        ];

        $descriptions = [
            'Sweet and creamy, perfect for snacking',
            'Rich flavor, great for cooking or baking',
            'Vibrant red color with unique taste',
            'Small and delicate, ideal for hand snacking',
            'Classic variety, smooth texture',
            'Unique blue-tinted skin with vanilla flavor',
            'Golden sweet banana with excellent shelf life',
            'Squat shape with creamy texture and rich flavor',
        ];

        return [
            'name' => fake()->randomElement($bananaVarieties),
            'description' => fake()->randomElement($descriptions),
            'price' => fake()->randomFloat(2, 0.50, 3.99),
            'quantity' => fake()->numberBetween(10, 500),
        ];
    }

    /**
     * Indicate that the banana is out of stock.
     *
     * @return $this
     */
    public function outOfStock(): static
    {
        return $this->state(fn (array $attributes) => [
            'quantity' => 0,
        ]);
    }

    /**
     * Indicate that the banana is premium priced.
     *
     * @return $this
     */
    public function premium(): static
    {
        return $this->state(fn (array $attributes) => [
            'price' => fake()->randomFloat(2, 4.00, 8.99),
        ]);
    }
}
