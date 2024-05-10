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
            $table->string('dni_camarero');
            $table->smallInteger('cant_clientes');
            $table->foreign('dni_camarero')->references('dni')->on('user');
            $table->timestamps();
        });

        DB::table('mesa')->insert([
            [
                'dni_camarero' => '00000003C',
                'cant_clientes' => '1'
            ],
            [
                'dni_camarero' => '00000004D',
                'cant_clientes' => '2',
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
