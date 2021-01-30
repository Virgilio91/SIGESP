<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{
       protected $fillable =[
          'ordem_id','nome'
        ];
        public function ordem()
        {
            return $this->belongsTo('App\Models\Ordem','id', 'id');
        }
        public function generos()
        {
          return $this->hasMany('App\Models\Genero', 'ordem_id', 'id');
        }
}
