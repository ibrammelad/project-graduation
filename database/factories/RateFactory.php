<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\Rate;
use Illuminate\Database\Eloquent\Factories\Factory;

class RateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'star' => $this->faker->numberBetween(0,5),
            'doctor_id' => function(){
            return Doctor::all()->random();
            } ,
            'nurse_id' => function(){
            return Doctor::all()->random();
            }
        ];
    }
}
