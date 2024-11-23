<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas';

    protected $fillable = ['id_cliente', 'total', 'fecha', 'estado'];

    // Relación con el cliente
    public function cliente() {
        return $this->belongsTo(Clientes::class, 'id_cliente'); // 'id_cliente' es la clave foránea en la tabla ventas
    }

    
    public function detalles() {
        return $this->hasMany(DetalleVenta::class, 'id_venta');
    }
}
