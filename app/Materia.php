<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $table = 'materias';
    protected $primaryKey = 'idmateria';


    //Crear relaciones
    public function user()
    {
        return $this->$this->belongsTo('App\User', 'user_id');
    }
}
