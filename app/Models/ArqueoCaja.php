<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArqueoCaja extends Model
{
    use HasFactory;

    protected $table = 'arqueos_caja';
    
    protected $fillable = [
        'saldo_inicial', 'ingresos', 'egresos', 'saldo_final_esperado', 'saldo_real', 'diferencia', 'estado'
    ];
}
