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
        Schema::create('platos', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->foreign('id')->references('id')->on('productos');
            $table->string('dni');
            $table->foreign('dni')->references('dni')->on('user');
            $table->smallInteger('tiempo');
            $table->timestamps();
        });

        DB::table('platos')->insert([
            [
                'id' => '1',
                'dni' => '00000001A',
                'tiempo' => '5',
            ],
            [
                'id' => '2',
                'dni' => '00000002B',
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
