<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Transportadora;
use Faker\Generator as Faker;

class TransportadoraFactory extends Factory
{
    public function definition()
    {
        return [
            'nome' => $this->faker->company,
            'endereco' => $this->faker->streetAddress,
            'cidade' => $this->faker->city,
            'uf' => $this->faker->stateAbbr,
            'limite_credito' => $this->faker->numberBetween(1000, 10000),
            'data_analise_credito' => $this->faker->date,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
