<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ordem extends Model
{
  protected $fillable =[
    'classe_id', 'nome'
  ];
    public function classe()
    {
        return $this->belongsTo('App\Models\Classe','id', 'id');
    }
     public function familias(){
       return $this->hasMany('App\Models\Familia', 'ordem_id', 'id');
     }
}
