<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('usuarios'); // Eliminar la tabla si existe

        Schema::create('usuarios', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('nombre', 50);
            $table->string('correo_electronico', 255);
            $table->string('contrasena', 255);
            $table->enum('tipo_usuario', ['Admin', 'Standard'])->default('Standard');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
