<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Model_has_classe extends Model
{
    protected $fillable=[
        'classe_id'
    ];
    public function model(){
        return $this->morphTo();
    }
}
