<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    use HasFactory;
    protected $table = 'mesa';
    protected $fillable = ['nombre', 'cod_camarero', 'cant_clientes'];

    public function camarero()
    {
        return $this->belongsTo(User::class, 'cod_camarero');
    }

    public function comandas()
    {
        return $this->hasMany(Comanda::class, 'id_mesa');
    }
}