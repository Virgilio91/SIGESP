<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Valor_ecologico extends Model
{
  protected $fillable=[
    'valor'
  ];
    public function especies()
    {
      return $this->belongsToMany('App\Models\Especie', 'especie_valor_ecologicos' , 'valor_ecologico_id' , 'especie_id');
    }
}
