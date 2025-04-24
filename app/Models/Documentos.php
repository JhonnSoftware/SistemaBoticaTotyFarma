<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentos extends Model
{
    use HasFactory;

    protected $table = "documento";

    public function ventas(){

        return $this->hasMany(Venta::class, 'id_documento');
        
    }

    protected $fillable = ['id', 'nombre'];

}
