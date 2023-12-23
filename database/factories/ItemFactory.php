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
        $computerParts = [
            'CPU', 'GPU', 'RAM', 'Motherboard', 'SSD', 'HDD', 'Power Supply', 'Cooling Fan', 'Case', 'Keyboard',
            'Mouse', 'Monitor', 'Webcam', 'Microphone', 'Speakers', 'Ethernet Cable', 'Wi-Fi Adapter', 'Bluetooth Dongle'
        ];

        return [
            'photo' => $this->faker->imageUrl(),
            'name' => $this->faker->randomElement($computerParts),
            'code' => $this->faker->unique()->randomNumber(6),
            'ean' => $this->faker->unique()->ean13,
            'price' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
