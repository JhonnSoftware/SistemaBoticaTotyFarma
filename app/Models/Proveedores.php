<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    use HasFactory;

    public function productos() {
        return $this->hasMany(Producto::class, 'id_proveedor');
    }

    protected $table = 'proveedores'; // Define el nombre correcto de la tabla

    protected $fillable = [
        'ruc',
        'nombre',
        'telefono',
        'correo',
        'direccion',
        'estado',
    ];
}
