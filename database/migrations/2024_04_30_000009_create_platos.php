<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('platos', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->foreign('id')->references('id')->on('productos');
            $table->unsignedBigInteger('cod_camarero');
            $table->foreign('cod_camarero')->references('id')->on('users');
            $table->smallInteger('tiempo');
            $table->timestamps();
        });

        DB::table('platos')->insert([
            [
                'id' => '1',
                'cod_camarero' => '1',
                'tiempo' => '5',
            ],
            [
                'id' => '2',
                'cod_camarero' => '2',
                'tiempo' => '10',
            ],
            [
                'id' => '3',
                'cod_camarero' => '2',
                'tiempo' => '10',
            ],
            [
                'id' => '4',
                'cod_camarero' => '2',
                'tiempo' => '10',
            ],
            [
                'id' => '5',
                'cod_camarero' => '2',
                'tiempo' => '10',
            ],
            [
                'id' => '6',
                'cod_camarero' => '2',
                'tiempo' => '10',
            ], 
            [
                'id' => '7',
                'cod_camarero' => '2',
                'tiempo' => '10',
            ], 
            [
                'id' => '8',
                'cod_camarero' => '2',
                'tiempo' => '10',
            ], 
            [
                'id' => '9',
                'cod_camarero' => '2',
                'tiempo' => '10',
            ], 
            [
                'id' => '10',
                'cod_camarero' => '2',
                'tiempo' => '10',
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('platos');
    }
};
