<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Model_has_familia extends Model
{
    protected $fillable=[
        'familia_id'
    ];
    public function model(){
        return $this->morphTo();
    }
}
