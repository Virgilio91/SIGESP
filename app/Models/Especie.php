<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especie extends Model
{
  protected $fillable=[
    'user_id','genero_id','nome_cientifico','nome_comum','historia_ocorrencia','nivel__conservacao','categoria_especie','image'
  ];
    public function genero()
    {
      return $this->belongsTo('App\Models\Genero', 'id', 'id');
    }

    public function user()
    {
      return $this->belongsTo('App\User', 'id', 'id');
    }

    public function acs()
    {
      return $this->belongsToMany('App\Models\Ac','especie_acs');
    }

    public function condicoes_localidade()
    {
      return $this->belongsToMany('App\Models\Condicoes_localidade', 'condicoes_especies');
    }

    public function valor_ecologicos()
    {
      return $this->belongsToMany('App\Models\Valor_ecologico', 'especie_valor_ecologicos');
    }
    
}
