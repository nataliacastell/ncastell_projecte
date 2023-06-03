<?php

namespace Database\Factories;

use App\Models\Follow;
use Illuminate\Database\Eloquent\Factories\Factory;

class FollowFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Follow::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'follower_id' => $this->faker->numberBetween(1, 10), // Ajusta los límites según tus necesidades
            'following_id' => $this->faker->numberBetween(1, 10), // Ajusta los límites según tus necesidades
        ];
    }
}
