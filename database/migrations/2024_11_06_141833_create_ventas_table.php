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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->unsignedBigInteger('id_cliente');
            $table->decimal('total', 10, 2);
            $table->dateTime('fecha');
            $table->string('estado');
            $table->unsignedBigInteger('id_pago');
            $table->unsignedBigInteger('id_documento');
            $table->timestamps();

            // Relación con la tabla proveedores
            $table->foreign('id_cliente')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('id_pago')->references('id')->on('tipopago')->onDelete('cascade');
            $table->foreign('id_documento')->references('id')->on('documento')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // Desactivar restricciones
        Schema::dropIfExists('ventas');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};

