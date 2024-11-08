<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;

    public function ventas()
    {
        return $this->hasMany(Venta::class, 'id_cliente'); // si estás usando 'id_cliente'
    }
    
    // Los campos que puedes asignar masivamente
    protected $fillable = ['dni', 'nombre', 'telefono', 'direccion', 'estado'];

    // Asegúrate de que la tabla esté correctamente definida si es necesario
    protected $table = 'clientes'; // Laravel infiere el nombre en plural por defecto
}
