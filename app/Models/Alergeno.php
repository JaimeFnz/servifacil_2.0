<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alergeno extends Model
{
    protected $fillable = ['nombre'];

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'tiene', 'id_alergeno', 'id_producto');
    }
}
