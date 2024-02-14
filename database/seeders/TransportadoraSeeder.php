<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transportadora;

class TransportadoraSeeder extends Seeder
{
    public function run()
    {
        Transportadora::factory(10)->create();
    }
}
