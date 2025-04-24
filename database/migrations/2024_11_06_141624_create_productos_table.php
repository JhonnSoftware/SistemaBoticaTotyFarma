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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->text('descripcion');
            $table->string('presentacion');
            $table->decimal('precio_compra', 8, 2);
            $table->decimal('precio_venta', 8, 2);
            $table->integer('cantidad')->default(0);
            $table->integer('stock_minimo');
            $table->string('laboratorio');
            $table->date('fecha_vencimiento');
            $table->string('foto');
            $table->foreignId('id_proveedor')->constrained('proveedores');
            $table->foreignId('id_categoria')->constrained('categorias');
            $table->string('estado'); // Activo por defecto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // Desactivar restricciones
        Schema::dropIfExists('productos');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); 
    }
};