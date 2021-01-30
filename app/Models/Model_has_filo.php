<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Model_has_filo extends Model
{
    protected $fillable=[
        'filo_id'
    ];
    public function model(){
        return $this->morphTo();
    }
}
