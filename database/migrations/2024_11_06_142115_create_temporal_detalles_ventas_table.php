<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('temporal_detalles_ventas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_producto');
            $table->integer('cantidad');
            $table->decimal('precio', 8, 2);
            $table->decimal('sub_total', 10, 2);
            $table->timestamps();

            // Clave foránea
            $table->foreign('id_producto')->references('id')->on('productos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temporal_detalle_ventas');
    }
};

