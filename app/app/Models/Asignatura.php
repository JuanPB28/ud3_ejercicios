<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    protected $table = 'Asignatura';
    protected $fillable = ['nombre', 'descripcion'];
    public $timestamps = false;

    public function notas()
    {
        return $this->hasMany(Nota::class, 'asignatura_id');
    }

    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class, 'Nota', 'asignatura_id', 'alumno_id');
    }
}
