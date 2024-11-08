<?php

namespace Database\Factories;

use App\Models\Categorias;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriasFactory extends Factory
{
    protected $model = Categorias::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->word,
            'estado' => 1, // Activo por defecto
        ];
    }
}