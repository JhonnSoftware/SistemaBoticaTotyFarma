<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $table = 'compras';

    protected $fillable = ['id_proveedor', 'total', 'fecha', 'estado'];

    public function proveedor() {
        return $this->belongsTo(Proveedores::class, 'id_proveedor');
    }
    
    public function detalles() {
        return $this->hasMany(DetalleCompra::class, 'id_compra');
    }
}
