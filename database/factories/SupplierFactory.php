<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $locale = 'id_ID';
        
        return [
            'nama' => fake($locale)->company(),
            'alamat' => fake($locale)->address(),
            'no_hp' => fake($locale)->phoneNumber(),
            'lead_time' => 2,
        ];
    }
}
