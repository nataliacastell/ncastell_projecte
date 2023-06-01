<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Publicacion;

class PublicacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Publicacion::factory()->count(20)->create();
    }
}
