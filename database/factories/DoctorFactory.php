<?php

namespace Database\Factories;

use App\Models\Doctor;
use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class DoctorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Doctor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'salary' => $this->faker->numberBetween(1500 , 5000) ,
            'services' => $this->faker->word ,
            'qualifications' => $this->faker->word,
            'lang' =>   $this->faker->numberBetween('30.753989', '31.2357'),
            'lat' => $this->faker->numberBetween('28.091889','30.0444'),
            'from' => '9 pm',
            'to' => '12 Am'

        ];
    }
}
