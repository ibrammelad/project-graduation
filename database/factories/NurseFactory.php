<?php

namespace Database\Factories;

use App\Models\Nurse;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class NurseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Nurse::class;

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
            'qualifications' => $this->faker->word(),
            'from' => '9 pm',
            'to' => '12 Am',
            'status' => $this->faker->numberBetween(0,1),
            'user_id' => function(){
                return  User::all()->random();} ,
        ];
    }
}
