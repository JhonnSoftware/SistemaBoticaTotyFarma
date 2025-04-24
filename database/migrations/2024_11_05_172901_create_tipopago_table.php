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
        Schema::create('tipopago', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {   
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // Desactivar restricciones
        Schema::dropIfExists('tipopago');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};
