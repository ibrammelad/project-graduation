<?php

namespace Database\Seeders;

use App\Models\LocationPersonInteract;
use Database\Factories\LocationPersonInteractFactory;
use Illuminate\Database\Seeder;

class LocationPersonInteractSeeder extends Seeder
{

    public function run()
    {
        LocationPersonInteract::factory(5)->create();
    }
}
