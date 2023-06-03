<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(UsuarioSeeder::class);
        $this->call(PublicacionSeeder::class);
        $this->call(FollowSeeder::class);

    }
}
