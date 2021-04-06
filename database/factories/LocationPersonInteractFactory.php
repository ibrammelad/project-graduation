<?php

namespace Database\Factories;

use App\Models\LocationPerson_interact;
use App\Models\LocationPersonInteract;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationPersonInteractFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LocationPersonInteract::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_1' => function(){
                return User::all()->random();
            },
            'user_2' => function(){
                return User::all()->random();
            },
            'lang' =>   $this->faker->numberBetween('30.753989', '31.2357'),
            'lat' => $this->faker->numberBetween('28.091889','30.0444'),
        ];
    }
}
