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
        Schema::create('arqueos_caja', function (Blueprint $table) {
            $table->id();
            $table->decimal('saldo_inicial', 10, 2); // Saldo al iniciar el día
            $table->decimal('ingresos', 10, 2); // Ingresos registrados durante el día
            $table->decimal('egresos', 10, 2); // Egresos registrados durante el día
            $table->decimal('saldo_final_esperado', 10, 2); // Saldo esperado al final del día
            $table->decimal('saldo_real', 10, 2)->nullable(); // El saldo real contado en el arqueo
            $table->decimal('diferencia', 10, 2)->nullable(); // Diferencia entre saldo esperado y real
            $table->string('estado')->default('Abierto'); // Estado del arqueo (Abierto, Cerrado)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arqueos_caja');
    }
};
