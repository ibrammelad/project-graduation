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
        $lang = 31.2357;
        $long = -84.3880;
        return [
            'user_id' => function(){
                return User::all()->random();
            },
//            'lang'=> $this->faker->latitude($min = ($lang-mt_rand(0,20)), $max = ($lang+mt_rand(0,20))),
//            'lat' =>$this->faker->longitude($min = ($long-mt_rand(0,20)), $max = ($long+mt_rand(0,20))),
            'lang'=> $this->faker->latitude(30.753989, 31.2357),
            'lat' =>$this->faker->longitude(28.091889, 30.0444),
        ];
    }
}
