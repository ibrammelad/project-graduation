<?php

namespace Database\Factories;

use App\Models\Admin;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Admin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = Faker::create('en_GB');

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $faker->phoneNumber,
            'password' => bcrypt('123456'), // 123456
        ];
    }
}
