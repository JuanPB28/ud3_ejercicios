<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'Post';
    protected $fillable = ['titulo', 'contenido'];
    public $timestamps = false;

    public function usuario()
    {
        return $this->belongsTo(Alumno::class, 'usuario_id');
    }
}
