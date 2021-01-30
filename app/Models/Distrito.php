<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    protected $fillable=[
        'provincia_id','nome'
    ];

    public function provincia()
    {
        return $this->belongsTo('App\Models\Provincia','id', 'id');
    }
}
