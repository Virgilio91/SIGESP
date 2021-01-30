<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Condicoes_localidade extends Model
{
    protected $fillable=[
        'reproducao','alimentacao','vegetacao','abrigo','observacoes'
    ];
    public function especies()
    {
        return $this->belongsToMany('App/Models/Especie', 'condicoes_especies');
    }
}
