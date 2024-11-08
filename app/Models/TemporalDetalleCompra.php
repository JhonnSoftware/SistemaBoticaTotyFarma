<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporalDetalleCompra extends Model
{
    use HasFactory;

    protected $table = 'temporal_detalles_compra';

    // Agregar los campos que permitirás para asignación masiva
    protected $fillable = [
        'id_producto',
        'cantidad',
        'precio',
        'sub_total',
    ];
    
    public function producto() {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
