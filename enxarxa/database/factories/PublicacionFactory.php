<?php

namespace Database\Factories;

use App\Models\Publicacion;
use Illuminate\Database\Eloquent\Factories\Factory;

class PublicacionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Publicacion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'usuario_id' => $this->faker->numberBetween(1, 100), // Ajusta los límites según tus necesidades
            'texto' => $this->faker->text,
            'imagen' => $this->faker->imageUrl(),
            'likes' => $this->faker->numberBetween(0, 100),
            'fecha_creacion' => $this->faker->dateTime,
            'fecha_modificacion' => $this->faker->optional()->dateTime,
            'eliminado' => $this->faker->boolean(10) // 10% de probabilidad de estar eliminado
        ];
    }
}
