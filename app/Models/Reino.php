<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Filo;

class Reino extends Model
{
  protected $fillable = [
    'nome'
];
     //relacionamento one to Many entre reino e filo
     public function filos(){
        return $this->hasMany('App\Models\Filo', 'reino_id', 'id');
      }
}
