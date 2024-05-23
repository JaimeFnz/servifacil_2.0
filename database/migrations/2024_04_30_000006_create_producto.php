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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->double('precio');
            $table->string('imagen')->default('stock.png');
            $table->enum('tipo', ['primero', 'segundo', 'postre', 'picapica', 'bebida']);
            $table->timestamps();
        });

        DB::table('productos')->insert([
            // Primeros
            [
                'nombre' => 'Ensalada César',
                'precio' => 8.99,
                'tipo' => 'primero',
            ],
            [
                'nombre' => 'Gazpacho Andaluz',
                'precio' => 6.49,
                'tipo' => 'primero',
            ],
            // Segundos
            [
                'nombre' => 'Solomillo de Ternera',
                'precio' => 15.99,
                'tipo' => 'segundo',
            ],
            [
                'nombre' => 'Pescado a la Plancha',
                'precio' => 12.49,
                'tipo' => 'segundo',
            ],
            // Postres
            [
                'nombre' => 'Tarta de Chocolate',
                'precio' => 6.99,
                'tipo' => 'postre',
            ],
            [
                'nombre' => 'Helado de Vainilla',
                'precio' => 4.49,
                'tipo' => 'postre',
            ],
            // Picapica
            [
                'nombre' => 'Tablas de Queso',
                'precio' => 10.99,
                'tipo' => 'picapica',
            ],
            [
                'nombre' => 'Tabla de Embutidos',
                'precio' => 11.49,
                'tipo' => 'picapica',
            ],
        ]);
        
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
