<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Comanda extends Model
{
    use HasFactory;

    protected $fillable = ['id_mesa', 'finalizada'];
    protected $table = 'comanda';

    public function isDone(){
        return $this->finalizada === true;
    }

    public function mesa()
    {
        return $this->belongsTo(Mesa::class, 'id_mesa');
    }
    
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'contiene', 'id_comanda', 'id_producto');
    }

    public function validate(array $data)
    {
        return Validator::make($data, [
            'id_mesa' => 'required|exists:mesa,id',
        ])->validate();
    }
}
