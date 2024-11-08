<?php

namespace Database\Factories;

use App\Models\Producto;
use App\Models\Proveedores;
use App\Models\Categorias;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    protected $model = Producto::class;

    public function definition()
    {
        return [
            'codigo' => $this->faker->unique()->numerify('PROD####'),
            'descripcion' => $this->faker->sentence,
            'precio_compra' => $this->faker->randomFloat(2, 10, 100),
            'precio_venta' => $this->faker->randomFloat(2, 20, 150),
            'cantidad' => $this->faker->numberBetween(1, 100),
            'id_proveedor' => Proveedores::factory(), // Relación con Proveedor
            'id_categoria' => Categorias::factory(), // Relación con Categoria
            'estado' => 1, // Estado activo por defecto
        ];
    }
}