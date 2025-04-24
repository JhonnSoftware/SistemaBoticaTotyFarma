<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPago extends Model
{
    use HasFactory;

    protected $table = "tipopago";

    public function ventas(){
        return $this->hasMany(Venta::class, 'id_pago');
    }

    protected $fillable = ['id','nombre'];
}
