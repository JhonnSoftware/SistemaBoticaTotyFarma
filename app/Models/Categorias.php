<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;

    public function productos() {
        return $this->hasMany(Producto::class, 'id_categoria');
    }

    protected $table = 'categorias'; // Define el nombre correcto de la tabla

    protected $fillable = [
        'nombre',
        'estado',
    ];
    
}
