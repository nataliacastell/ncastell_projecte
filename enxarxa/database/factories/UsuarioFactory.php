<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UsuarioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Usuario::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->name,
            'correo_electronico' => $this->faker->unique()->safeEmail,
            'contrasena' => bcrypt('password'), // Puedes cambiar 'password' por la contraseña deseada para los usuarios generados
            'tipo_usuario' => $this->faker->randomElement(['Admin', 'Standard'])
        ];
    }
}
