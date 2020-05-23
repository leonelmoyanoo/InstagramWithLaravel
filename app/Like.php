<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //Nombre de la tabla
    protected $table = 'likes';

    //Relacion Many To One (de muchos a uno)
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    //Relacion Many To One (de muchos a uno)
    public function image(){
        return $this->belongsTo('App\Image','image_id');
    }
}
