<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear usuario Admin
        Usuario::create([
            'nombre' => 'Admin',
            'correo_electronico' => 'admin@admin.com',
            'contrasena' => Hash::make('Admin'),
            'tipo_usuario' => 'Admin',
        ]);

        Usuario::factory()->count(20)->create();
    }
}
