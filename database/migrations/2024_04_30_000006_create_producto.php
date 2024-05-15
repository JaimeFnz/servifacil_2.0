<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->double('precio');
            $table->string('imagen')->default('public\img\stock.png');
            $table->enum('tipo', ['primero', 'segundo', 'postre', 'entrante', 'picapica', 'bebida']);
            $table->unsignedBigInteger('alergias');
            $table->foreign('alergias')->references('id')->on('alergeno');
            $table->timestamps();
        });

        DB::table('producto')->insert([
            [
                'nombre' => 'macarrones',
                'precio' => '7.99',
                'tipo' => 'primero',
                'alergias' => '1',
            ],
            [
                'nombre' => 'spaguetti',
                'precio' => '5.99',
                'tipo' => 'primero',
                'alergias' => '1',
            ]
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('producto');
    }
};
