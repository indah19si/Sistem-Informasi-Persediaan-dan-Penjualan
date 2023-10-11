<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransaksiPembelian>
 */
class TransaksiPembelianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        static $number = 1;
        $trxUniqueCode = 'PBL';
        $timeCreated = fake()->dateTimeBetween('2020-01-01', 'now');

        return [
            'trx_code' => $trxUniqueCode . str_pad($number++, 5, '0', STR_PAD_LEFT),
            'created_at' => $timeCreated,
            'updated_at' => $timeCreated,
        ];
    }
}
