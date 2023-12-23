<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'photo' => $this->faker->imageUrl(), // Genera una URL de imagen ficticia
            'name' => $this->faker->word,        // Genera una palabra ficticia
            'code' => $this->faker->unique()->randomNumber(6), // Genera un código único de 6 dígitos
            'ean' => $this->faker->unique()->ean13, // Genera un código EAN-13 único
            'price' => $this->faker->randomFloat(2, 10, 1000), // Genera un precio aleatorio con 2 decimales
        ];
    }
}
