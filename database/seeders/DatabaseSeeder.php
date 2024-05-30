<?php

namespace Database\Seeders;

use App\Models\Empresa;
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
        $usr = ['adrian', 'angel', 'antonio', 'bitor', 'estela', 'ruben', 'valentin', 'test'];

        DB::table('empresa')->insert([
            'name' => 'cachaw'
        ]);

        $co = Empresa::where('name', 'cachaw')->select('id')->first();

        foreach ($usr as $user) {
            $dni = User::generateDNI();
            DB::table('users')->insert([
                'dni' => $dni,
                'name' => $user,
                'email' => $user . '@gmail.com',
                'password' => Hash::make($user . '1234'),
                'id_empresa' => $co->id,
                'puesto' => 'admin',
            ]);
        }
    }
}