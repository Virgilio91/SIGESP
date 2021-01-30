<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubFilo extends Model
{
    protected $fillable=[
        'sub_filo_id','nome', 'grupo'
    ];
    
    public function model_has_filos(){
        return $this->morphMany(Model_has_filo::class, 'model');
    } 
    public function model_has_classes(){
        return $this->morphMany(Model_has_classe::class, 'model');
    } 
}
