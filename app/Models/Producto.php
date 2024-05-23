<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'precio', 'imagen', 'tipo'];

    public function alergenos()
    {
        return $this->belongsToMany(Alergeno::class, 'tiene', 'id_producto', 'id_alergeno');
    }

    public function comandas()
    {
        return $this->belongsToMany(Comanda::class, 'contiene', 'cantidad', 'id_producto', 'id_comanda');
    }
}
