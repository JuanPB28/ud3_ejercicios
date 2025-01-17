<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Perfil')->insert([
            ['usuario_id' => 1, 'biografia' => 'Juan Pérez es un estudiante de matemáticas'],
            ['usuario_id' => 2, 'biografia' => 'María López es una estudiante de historia'],
            ['usuario_id' => 3, 'biografia' => 'Carlos García es un estudiante de ciencias'],
        ]);
    }
}
