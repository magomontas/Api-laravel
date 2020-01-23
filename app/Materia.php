<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $table = 'materias';
    protected $primaryKey = 'idmateria';
    protected $hidden = [
        'created_at','updated_at'
    ];

    public function userMateria(){
        return $this->belongsTo('App\User');
    }

    //Crear relaciones
    public function user()
    {
        return $this->$this->belongsTo('App\User', 'user_id');
    }
}
