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
        Schema::create('temporal_detalles_compra', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_producto');
            $table->integer('cantidad');
            $table->decimal('precio', 8, 2);
            $table->decimal('sub_total', 10, 2);
            $table->timestamps();

            $table->foreign('id_producto')->references('id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // Desactivar restricciones
        Schema::dropIfExists('temporal_detalles_compra');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};
