<?php

namespace Database\Seeders;

use App\Models\LocationPerson;
use Illuminate\Database\Seeder;

class LocationPersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LocationPerson::factory(1000)->create();
    }
}
