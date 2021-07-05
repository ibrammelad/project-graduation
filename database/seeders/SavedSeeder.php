<?php

namespace Database\Seeders;

use App\Models\Saved;
use Illuminate\Database\Seeder;

class SavedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Saved::factory(40)->create();
    }
}
