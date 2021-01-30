<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ac extends Model
{
    protected $fillable =[
        'provincia_id','nome','Categoria','Tipo'
    ];
   

    public function provincia()
    {
        return $this->belongsTo('App\Models\Provincia','id', 'id');
    }
    public function especies()
    {
        return $this->belongsToMany('App/Models/Especie','especie_acs');
    }
}
