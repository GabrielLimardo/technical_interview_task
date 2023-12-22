<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use Faker\Factory as Faker; // Importa el Faker para generar datos ficticios

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Lista de nombres de piezas de computadoras ficticias
        $computerParts = [
            'CPU', 'GPU', 'RAM', 'Motherboard', 'SSD', 'HDD', 'Power Supply', 'Cooling Fan', 'Case', 'Keyboard',
            'Mouse', 'Monitor', 'Webcam', 'Microphone', 'Speakers', 'Ethernet Cable', 'Wi-Fi Adapter', 'Bluetooth Dongle'
        ];

        // Genera 30 productos ficticios con nombres de piezas de computadoras
        for ($i = 0; $i < 30; $i++) {
            Item::create([
                'photo' => $faker->imageUrl(400, 300),
                'name' => $computerParts[$faker->numberBetween(0, count($computerParts) - 1)], // Selecciona un nombre de pieza al azar
                'code' => $faker->unique()->ean8,
                'ean' => $faker->unique()->ean13,
                'price' => $faker->randomFloat(2, 50, 1000) // Precio aleatorio entre 50 y 1000 con 2 decimales
            ]);
        }
    }
}
