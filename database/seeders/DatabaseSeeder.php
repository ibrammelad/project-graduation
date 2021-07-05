<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            DoctorSeeder::class,
            NurseSeeder::class,
            LocationPersonSeeder::class,
            LocationPersonInteractSeeder::class,
            //RateSeeder::class,
            HospitalSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
           // LikeSeeder::class,
            SavedSeeder::class,
            AdminSeeder::class,

        ]);
    }
}
