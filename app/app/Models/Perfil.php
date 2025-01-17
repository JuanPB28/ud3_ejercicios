<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table = 'Perfil';
    protected $fillable = ['biografia'];
    public $timestamps = false;

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'usuario_id');
    }
}
