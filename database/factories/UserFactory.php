<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\Nurse;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Factory as Faker;


class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

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
            'email_verified_at' => now(),
            'password' => bcrypt('123456'), // 123456
            'remember_token' => Str::random(10),
            'status' => $this->faker->numberBetween(0,1),
            'image' => '/images/lancera.PNG',
            'showMail' =>$this->faker->numberBetween(0,1),
            'showName' =>$this->faker->numberBetween(0,1),
            'showNearly' =>$this->faker->numberBetween(0,1),
            'doctor_details_id' => function(){
                return  Doctor::all()->random();} ,
            'nurse_details_id' => function(){
                return  Nurse::all()->random();} ,

        ];
    }
}
