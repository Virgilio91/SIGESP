<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfraClasse extends Model
{
    protected $fillable =[
        'nome'
    ];
    public function model_has_classes(){
        return $this->morphMany(Model_has_classe::class, 'model');
    } 

    public function model_has_ordem(){
        return $this->morphMany(Model_has_ordem::class, 'model');
    } 
}
