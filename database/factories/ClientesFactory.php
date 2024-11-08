<?php

namespace Database\Factories;

use App\Models\Clientes;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientesFactory extends Factory
{
    protected $model = Clientes::class;

    public function definition()
    {
        return [
            'dni' => $this->faker->unique()->numberBetween(10000000, 99999999),
            'nombre' => $this->faker->sentence(),
            'telefono' => $this->faker->sentence(),
            'direccion' => $this->faker->sentence(),
            'estado' => $this->faker->sentence(), // Activo por defecto
        ];
    }
}
