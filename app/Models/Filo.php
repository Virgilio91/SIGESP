<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Reino;

class Filo extends Model
{
  protected $fillable=[
    'reino_id','nome' 
  ];
  
    //
          //relacionamento one to Many(inverso) entre reino e filo
          public function reino()
          {
              return $this->belongsTo('App\Models\Reino','id', 'id');
          }
       //relacionamento com a classe
          public function classes(){
            return $this->hasMany('App\Models\Classe', 'filo_id', 'id');
          }

         
}
