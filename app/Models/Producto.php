<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['nombre', 'precio', 'imagen', 'tipo'];

    public function alergenos()
    {
        return $this->belongsToMany(Alergeno::class, 'tiene', 'id_producto', 'id_alergeno');
    }
}
