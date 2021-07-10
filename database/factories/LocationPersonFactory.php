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
//            'lang'=> $this->faker->latitude($min = ($lang-mt_rand(0,20)), $max = ($lang+mt_rand(0,20))),
//            'lat' =>$this->faker->longitude($min = ($long-mt_rand(0,20)), $max = ($long+mt_rand(0,20))),
            'lat'=> $this->faker->randomNumber(28.0911546, 28.0911586),
            'lang' =>$this->faker->randomNumber(30.7475922, 30.7475983),
        ];
    }
}
