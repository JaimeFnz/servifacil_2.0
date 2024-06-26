<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('dni')->unique();
            $table->string('name');
            $table->string('surname')->default('')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('id_empresa')->nullable(); 
            $table->enum('puesto', ['admin', 'jefe', 'camarero', 'cocinero'])->default('camarero');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        DB::table('users')->insert([
            [
                'dni' => '00000000A',
                'name' => 'Jaime',
                'surname' => '',
                'email' => 'jaime@gmail.com',
                'password' => bcrypt('jaime1234'),
                'id_empresa' => 1,
                'puesto' => 'jefe'
            ],
            [
                'dni' => '00000000B',
                'name' => 'Juan',
                'surname' => '',
                'email' => 'juan@gmail.com',
                'password' => bcrypt('juan1234'),
                'id_empresa' => 1,
                'puesto' => 'camarero'
            ],
            [
                'dni' => '00000001A',
                'name' => 'Deborah',
                'surname' => '',
                'email' => 'deborah@gmail.com',
                'password' => bcrypt('deborah1234'),
                'id_empresa' => 2,
                'puesto' => 'jefe',
            ],
            [
                'dni' => '00000002B',
                'name' => 'Nitales',
                'surname' => '',
                'email' => 'nitales@gmail.com',
                'password' => bcrypt('nitales1234'),
                'id_empresa' => 3,
                'puesto' => 'jefe',
            ],
            [
                'dni' => '00000003C',
                'name' => 'Armando',
                'surname' => 'Este Banquito',
                'email' => 'armando@gmail.com',
                'password' => bcrypt('armando1234'),
                'id_empresa' => 2,
                'puesto' => 'camarero',
            ],
            [
                'dni' => '00000004D',
                'name' => 'Maria',
                'surname' => '',
                'email' => 'maria@gmail.com',
                'password' => bcrypt('maria1234'),
                'puesto' => 'camarero',
                'id_empresa' => 3,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
