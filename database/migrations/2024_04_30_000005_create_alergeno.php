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
        Schema::create('alergeno', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        DB::table('alergeno')->insert([
            [
                'nombre' => 'celiaquia',
            ],
            [
                'nombre' => 'lactosa',
            ],
            [
                'nombre' => 'frutos secos',
            ],
            [
                'nombre' => 'marisco',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alergeno');
    }
};
