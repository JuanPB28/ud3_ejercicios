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
        Schema::create('Alumno', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('email')->unique();
        });

        Schema::create('Asignatura', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion');
        });

        Schema::create('Nota', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumno_id')->constrained('Alumno');
            $table->foreignId('asignatura_id')->constrained('Asignatura');
            $table->float('nota');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Alumno');
        Schema::dropIfExists('Asignatura');
        Schema::dropIfExists('Nota');
    }
};
