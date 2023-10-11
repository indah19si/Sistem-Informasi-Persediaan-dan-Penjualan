<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));
        static $sequenceNumber = 1;

        return [
            'kode' => 'B' . str_pad($sequenceNumber++, 4, '0', STR_PAD_LEFT),
            'nama' => $faker->unique()->foodName(),
            'harga_beli' => fake()->randomNumber(5),
            'harga_jual' => fake()->randomNumber(5),
            'stok' => fake()->randomNumber(3, true),
            'id_supplier' => fake()->numberBetween(1, 15),
            'id_satuan' => fake()->numberBetween(1, 3),
        ];
    }
}
