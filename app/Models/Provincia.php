<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    public function acs(){
        return $this->hasMany('App\Models\Ac', 'provincia_id', 'id');
      }
    public function distritos(){
        return $this->hasMany('App\Models\Distrito', 'provincia_id', 'id');
    }
}
