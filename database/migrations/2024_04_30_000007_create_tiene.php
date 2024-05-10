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
        Schema::create('tiene', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_producto');
            $table->foreign('id_producto')->references('id')->on('productos');
            $table->unsignedBigInteger('id_alergeno');
            $table->foreign('id_alergeno')->references('id')->on('alergeno');
            $table->timestamps();
        });

        DB::table('tiene')->insert([
            [
                'id_producto' => '1',
                'id_alergeno' => '1',
            ],
            [
                'id_producto' => '2',
                'id_alergeno' => '2',
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiene');
    }
};
