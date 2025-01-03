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
}
