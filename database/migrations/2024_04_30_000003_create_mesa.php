<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mesa', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->unsignedBigInteger('cod_camarero');
            $table->smallInteger('cant_clientes');
            $table->foreign('cod_camarero')->references('id')->on('users');
            $table->timestamps();
        });

        DB::table('mesa')->insert([
            [
                'cod_camarero' => '1',
                'cant_clientes' => '1',
                'nombre' => 'esquina derecha',
            ],
            [
                'cod_camarero' => '1',
                'cant_clientes' => '2',
                'nombre' => 'esquina izquierda',
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mesa');
    }
};
