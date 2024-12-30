<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GestionNotasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insertar datos en la tabla Alumno
        DB::table('Alumno')->insert([
            ['nombre' => 'Juan Pérez', 'email' => 'juan.perez@example.com'],
            ['nombre' => 'María López', 'email' => 'maria.lopez@example.com'],
            ['nombre' => 'Carlos García', 'email' => 'carlos.garcia@example.com'],
        ]);

        // Insertar datos en la tabla Asignatura
        DB::table('Asignatura')->insert([
            ['nombre' => 'Matemáticas', 'descripcion' => 'Curso de matemáticas básicas'],
            ['nombre' => 'Historia', 'descripcion' => 'Curso de historia mundial'],
            ['nombre' => 'Ciencias', 'descripcion' => 'Curso de ciencias naturales'],
        ]);

        // Insertar datos en la tabla Nota
        DB::table('Nota')->insert([
            ['alumno_id' => 1, 'asignatura_id' => 1, 'nota' => 8.5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['alumno_id' => 1, 'asignatura_id' => 2, 'nota' => 7.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['alumno_id' => 2, 'asignatura_id' => 1, 'nota' => 9.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['alumno_id' => 2, 'asignatura_id' => 3, 'nota' => 6.5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['alumno_id' => 3, 'asignatura_id' => 2, 'nota' => 8.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['alumno_id' => 3, 'asignatura_id' => 3, 'nota' => 7.5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
