<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTelefonoNullableInClientesTable extends Migration
{
    /**
     * Ejecutar las migraciones.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientes', function (Blueprint $table) {
            // Modificar la columna 'telefono' para permitir valores nulos
            $table->string('telefono')->nullable()->change();
            $table->string('direccion')->nullable()->change();
        });
    }

    /**
     * Revertir las migraciones.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clientes', function (Blueprint $table) {
            // Volver a hacer que 'telefono' sea obligatorio (si es necesario)
            $table->string('telefono')->nullable(false)->change();
            $table->string('direccion')->nullable(false)->change();
        });
    }
}
