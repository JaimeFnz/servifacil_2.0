<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    protected $table = 'empresa';
    protected $fillable = ['name', 'jefe_id'];

    public function hasEmployes()
    {
        return $this->hasMany(User::class, 'id_empresa');
    }

    public function returnBoss(){

        $id = $this->jefe_id; 
        $usr = User::where('id', $id)->first();
        return $usr;
    }

}
