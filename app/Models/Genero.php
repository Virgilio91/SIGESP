<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
        protected $fillable=['familia_id','nome'];
       //
       public function ordem()
       {
         return $this->belongsTo('App\Models\Ordem', 'id', 'id');
       }
   
       public function Species(){
         return $this->hasMany('App\Models\Specie', 'genero_id', 'id');
       }
}
