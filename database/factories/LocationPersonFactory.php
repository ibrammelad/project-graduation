<?php

namespace Database\Factories;

use App\Models\LocationPerson;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationPersonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LocationPerson::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => function(){
                return User::all()->random();
            },
            'lang' =>   $this->faker->numberBetween('30.753989', '31.2357'),
            'lat' => $this->faker->numberBetween('28.091889','30.0444'),
        ];
    }
}
