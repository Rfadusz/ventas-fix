<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id(); // identificador único
            $table->string('rut')->unique();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('email')->unique(); // será el username, @ventasfix.cl[cite: 1]
            $table->string('password'); // se almacenará cifrada[cite: 1]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};