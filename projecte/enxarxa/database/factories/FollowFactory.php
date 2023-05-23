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
            'usuario1_id' => $this->faker->numberBetween(1, 100), // Ajusta los límites según tus necesidades
            'usuario2_id' => $this->faker->numberBetween(1, 100), // Ajusta los límites según tus necesidades
            'fecha_creacion' => $this->faker->dateTime,
            'fecha_modificacion' => $this->faker->optional()->dateTime,
            'eliminado' => $this->faker->boolean(10) // 10% de probabilidad de estar eliminado
        ];
    }
}
