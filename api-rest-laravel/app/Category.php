<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // utilizar tabla de la base de datos
    protected $table = 'categories';
    
    //Relacion de uno a muchos. Una categoria tiene muchos posts 
    public function posts(){
        return $this->hasMany('App\Post');
    }
}
