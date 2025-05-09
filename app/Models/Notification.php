<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = "notifications";

    protected $fillable = ['id', 'message', 'producto_id', 'is_read'];
    
    public function producto(){
        return $this->belongsTo(Producto::class);
    }

}
