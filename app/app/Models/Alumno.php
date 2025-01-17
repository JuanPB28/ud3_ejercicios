<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table = 'Alumno';
    protected $fillable = ['nombre', 'email'];
    public $timestamps = false;

    public function notas()
    {
        return $this->hasMany(Nota::class, 'alumno_id');
    }

    public function asignaturas()
    {
        return $this->belongsToMany(Asignatura::class, 'Nota', 'alumno_id', 'asignatura_id');
    }

    public function perfil()
    {
        return $this->hasOne(Perfil::class, 'usuario_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'usuario_id');
    }
}
