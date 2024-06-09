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
            [
                'nombre' => 'Sopa de Tomate',
                'precio' => 7.49,
                'tipo' => 'primero',
            ],
            [
                'nombre' => 'Pasta Carbonara',
                'precio' => 9.99,
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
            [
                'nombre' => 'Pollo al Horno',
                'precio' => 11.99,
                'tipo' => 'segundo',
            ],
            [
                'nombre' => 'Lomo a la Parrilla',
                'precio' => 14.49,
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
            [
                'nombre' => 'Flan de Huevo',
                'precio' => 5.99,
                'tipo' => 'postre',
            ],
            [
                'nombre' => 'Mousse de Chocolate',
                'precio' => 7.49,
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
            [
                'nombre' => 'Patatas Bravas',
                'precio' => 8.99,
                'tipo' => 'picapica',
            ],
            [
                'nombre' => 'Croquetas Caseras',
                'precio' => 9.49,
                'tipo' => 'picapica',
            ],
            // Bebida
            [
                'nombre' => 'Cerveza',
                'precio' => 10.99,
                'tipo' => 'bebida',
            ],
            [
                'nombre' => 'Vino',
                'precio' => 11.49,
                'tipo' => 'bebida',
            ],
            [
                'nombre' => 'Refresco',
                'precio' => 2.99,
                'tipo' => 'bebida',
            ],
            [
                'nombre' => 'Agua Mineral',
                'precio' => 1.99,
                'tipo' => 'bebida',
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
