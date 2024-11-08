<?php

namespace Database\Factories;

use App\Models\Venta;
use App\Models\Clientes;
use Illuminate\Database\Eloquent\Factories\Factory;

class VentaFactory extends Factory
{
    protected $model = Venta::class;

    public function definition()
    {
        return [
            'id_cliente' => Clientes::factory(), // Crea un cliente automáticamente
            'total' => $this->faker->randomFloat(2, 10, 100), // Total entre 10 y 100
            'fecha' => $this->faker->date(),
            'estado' => 1, // Activo por defecto
        ];
    }
}
