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
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->datetime('fecha');
            $table->integer('cantidad');
            $table->decimal('total', 10, 2);
            $table->string('tipo');
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};
