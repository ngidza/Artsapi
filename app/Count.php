<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Count extends Model
{
    
    protected $fillable = [
        'artsummary_id','careentry_id','stage','value','tb_id','patient_id'
    ];
}