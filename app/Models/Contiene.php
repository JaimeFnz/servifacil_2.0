<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Contiene extends Model
{
    use HasFactory;

    protected $fillable = ['id_producto', 'id_comanda', 'cantidad'];
    protected $table = 'contiene';

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}