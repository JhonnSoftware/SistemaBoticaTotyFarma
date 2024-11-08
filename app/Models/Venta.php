<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas';

    protected $fillable = ['id_cliente', 'total', 'fecha', 'estado'];

    public function detalles() {
        return $this->hasMany(DetalleVenta::class, 'id_venta');
    }
}
