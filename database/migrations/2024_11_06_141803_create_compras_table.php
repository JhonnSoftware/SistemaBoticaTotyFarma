<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_proveedor');
            $table->decimal('total', 10, 2);
            $table->dateTime('fecha');
            $table->string('estado');
            $table->timestamps();
    
            // Relación con la tabla proveedores
            $table->foreign('id_proveedor')->references('id')->on('proveedores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // Desactivar restricciones
        Schema::dropIfExists('compras');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};
