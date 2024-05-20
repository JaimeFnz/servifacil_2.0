<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comanda extends Model
{
    use HasFactory;

    protected $fillable = ['id_mesa'];
    protected $table = 'comanda';
    public function mesa()
    {
        return $this->belongsTo(Mesa::class, 'id_mesa');
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'contiene', 'id_comanda', 'id_producto');
    }
}
