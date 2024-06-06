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
        Schema::create('contiene', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_comanda');
            $table->foreign('id_comanda')->references('id')->on('comanda');
            $table->unsignedBigInteger('id_producto');
            $table->foreign('id_producto')->references('id')->on('productos');
            $table->integer('cantidad')->default(1);
            $table->timestamps();
        });

        DB::table('contiene')->insert([
            [
                'id_comanda' => '1',
                'id_producto' => '1',
                'cantidad' => '2',
            ],
            [
                'id_comanda' => '1',
                'id_producto' => '2',
                'cantidad' => '3',
            ],
            [
                'id_comanda' => '1',
                'id_producto' => '3',
                'cantidad' => '3',
            ],
            [
                'id_comanda' => '1',
                'id_producto' => '4',
                'cantidad' => '6',
            ],
            [
                'id_comanda' => '1',
                'id_producto' => '5',
                'cantidad' => '4',
            ],
            [
                'id_comanda' => '1',
                'id_producto' => '6',
                'cantidad' => '4',
            ],
            [
                'id_comanda' => '1',
                'id_producto' => '7',
                'cantidad' => '5',
            ],
            [
                'id_comanda' => '2',
                'id_producto' => '2',
                'cantidad' => '6',
            ],
            [
                'id_comanda' => '2',
                'id_producto' => '4',
                'cantidad' => '8',
            ],
            [
                'id_comanda' => '2',
                'id_producto' => '6',
                'cantidad' => '10',
            ],
            [
                'id_comanda' => '2',
                'id_producto' => '8',
                'cantidad' => '12',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contiene');
    }
};
