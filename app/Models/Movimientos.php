<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Movimientos extends Model
{
    use HasFactory;

    protected $table = "movimientos";

    protected $fillable = ['fecha', 'cantidad', 'total', 'tipo', 'usuario_id'];

    public function usuario(){
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
