<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Model_has_ordem extends Model
{
    protected $fillable=[
        'ordem_id'
    ];
    public function model(){
        return $this->morphTo();
    }
}
