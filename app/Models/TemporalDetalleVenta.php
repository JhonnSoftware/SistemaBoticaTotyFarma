<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporalDetalleVenta extends Model
{
    use HasFactory;

    protected $table = 'temporal_detalles_ventas';

    public function producto() {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
