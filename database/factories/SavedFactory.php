<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Saved;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SavedFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Saved::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_id' => Post::all()->random(),
            'user_id' => User::all()->random(),
            'saved' => $this->faker->boolean
        ];
    }
}
