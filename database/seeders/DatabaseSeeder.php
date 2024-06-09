<?php

namespace Database\Seeders;

use App\Models\Comanda;
use App\Models\Empresa;
use App\Models\Mesa;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $usr = ['adrian', 'angel', 'antonio', 'bitor', 'estela', 'ruben', 'valentin', 'test', 'profesor'];

        DB::table('empresa')->insert([
            'name' => 'cachaw'
        ]);
        DB::table('empresa')->insert([
            'name' => 'profesores'
        ]);

        $co = Empresa::where('name', 'cachaw')->select('id')->first();
        $profesores = Empresa::where('name', 'profesores')->select('id')->first();

        for ($i = 0; $i < count($usr); $i++) {
            $user = $usr[$i];
            $dni = User::dniInator();
            $empresa_id = $i === count($usr) - 1 ? $profesores->id : $co->id;

            DB::table('users')->insert([
                'dni' => $dni,
                'name' => $user,
                'email' => $user . '@gmail.com',
                'password' => Hash::make($user . '1234'),
                'id_empresa' => $empresa_id,
                'puesto' => 'admin',
            ]);
        }


        DB::table('mesa')->insert([
            'cod_camarero' => '1',
            'cant_clientes' => '10',
            'nombre' => 'centro',
        ]);

        $table = Mesa::where('nombre', 'centro')->first();
        DB::table('comanda')->insert([
            'id_mesa' => $table->id,
            'finalizada' => false,
        ]);

        $note = Comanda::where('id_mesa', $table->id)->first();
        for ($i = 0; $i < 10; $i++) {
            DB::table('contiene')->insert([
                'id_comanda' => $note->id,
                'id_producto' => $this->randInator(),
                'cantidad' => $this->randInator(),
            ]);
        }
    }

    function randInator()
    {
        return rand(1, 10);
    }
}
