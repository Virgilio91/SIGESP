<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
  protected $fillable=[
    'filo_id', 'nome'
  ];
  
        //relacionamento one to Many(inverso) entre filo e classe
       public function filo(){
        return $this->belongsTo('App\Models\Filo', 'id', 'id');
      }
  
      public function ordems(){
        return $this->hasMany('App\Models\Ordem', 'classe_id', 'id');
      }
}
