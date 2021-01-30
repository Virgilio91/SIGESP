<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfraOrdem extends Model
{
    protected $fillable =[
        'nome'
    ];

    public function model_has_ordem(){
        return $this->morphMany(Model_has_ordem::class, 'model');
    } 

    public function model_has_familia(){
        return $this->morphMany(Model_has_familia::class, 'model');
    } 
}
